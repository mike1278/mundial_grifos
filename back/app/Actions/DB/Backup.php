<?php

namespace App\Actions\DB;

use App\Actions\DB\Class\BackupFile;
use App\Actions\DB\Class\BackupHandler;
use App\Actions\DB\Class\Base;
use App\Models\Dump;
use Carbon\Carbon;
use Config;
use Illuminate\Console\Command;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class Backup
{
    use AsAction, Base;

    public bool $commandHidden = false;
    public string $commandSignature = 'db:backup {--database=} {--filename=}';
    public string $commandDescription =  'Make database backup';
    private string $filePath;

    public function handle($database, $filename): string
    {
        $database = $this->getDatabase($database);

        $this->checkDumpFolder();

        $dbFile = new BackupFile($filename, $database, $this->getDumpsPath());
        $this->filePath = $dbFile->path();
        $fileName = $dbFile->name();

        $status = $database->dump($this->filePath);
        $handler = new BackupHandler($this->colors);

        if ($status) {
            return $handler->errorResponse('error');
        }

        if ($this->isCompressionEnabled()) {
            $this->compress();
            $fileName .= ".gz";
            $this->filePath .= ".gz";
        }

        Dump::create([
            'file' => $this->filePath,
            'file_name' => $fileName,
            'prefix' => Config::get('backup.dropbox.prefix', null),
            'encrypted' => false,
            'created_at' => Carbon::now()
        ]);

        return $handler->dumpResponse($fileName, $this->filePath, $fileName);
    }

    public function asController(Request $request): RedirectResponse
    {
        $this->handle(
            $request->database,
            $request->fileName,
        );

        return redirect()->route('backups.index');
    }

    public function asCommand(Command $command): void
    {
        $message = $this->handle($command->option('database'), $command->option('filename'));
        $command->line($message);
    }

    /**
     * Perform Gzip compression on file
     *
     * @return boolean
     */
    protected function compress(): bool
    {
        $command = sprintf('gzip -9 %s', $this->filePath);

        return $this->console->run($command);
    }

    protected function checkDumpFolder()
    {
        $dumpsPath = $this->getDumpsPath();

        if (!is_dir($dumpsPath)) {
            mkdir($dumpsPath);
        }
    }
}
