<?php

namespace App\Actions\DB;

use App\Actions\DB\Class\Base;
use App\Actions\DB\Class\DatabaseContract;
use App\Models\Dump;
use File;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\Finder\Finder;

class Restore
{
    use AsAction, Base;

    public DatabaseContract $database;
    public bool $commandHidden = false;
    public string $commandSignature = 'db:restore {--database=} {--file=} {--last}';
    public string $commandDescription =  'Restore a dump from `app/storage/dumps`';

    public function handle($database, $fileName, $last): string|Finder
    {
        $this->database = $this->getDatabase($database);

        if ($last) {
            $fileName = $this->lastBackupFile();

            if (!$fileName) {
                return 'No backups have been created.';
            }
        }

        if ($fileName) {
            return $this->restoreDump($fileName);
        }

        return $this->getAllDumps();
    }

    public function getValidator(Factory $factory, ActionRequest $request): Validator
    {
        return $factory->make($request->only('database', 'file', 'last'), [
            'database' => 'sometimes|required|string',
            'file'     => 'sometimes|required|string',
        ]);
    }

    public function asController(Request $request){

        $result = $this->handle(
            $request->database,
            $request->file,
            false
        );

        if(is_a($result, Finder::class)){
            return Inertia::render('Config/backupsDatabase', [
                'backups' => Dump::paginate(15),
            ]);
        }

        return redirect()->back();
    }

    public function asCommand(Command $command){
        $result = $this->handle(
            $command->option('database'),
            $command->option('file'),
            $command->option('last')
        );

        if(is_a($result, Finder::class)){
            $command->line($this->colors->getColoredString("\n" . 'Please select one of the following dumps:' . "\n", 'white'));

            $result->sortByName();
            foreach ($result as $dump) {
                $fileName = $dump->getFilename();

                $command->line($this->colors->getColoredString($fileName, 'brown'));
            }
            return;
        }

        $command->line($result);
    }

    protected function restoreDump($fileName): string
    {
        $dumps = Dump::get();
        $sourceFile = $this->getDumpsPath() . $fileName;

        if ($this->isCompressed($sourceFile)) {
            $sourceFile = $this->uncompress($sourceFile);
        }

        $status = $this->database->restore($this->getUncompressedFileName($sourceFile));

        if ($this->isCompressed($sourceFile)) {
            $this->uncompressCleanup($this->getUncompressedFileName($sourceFile));
        }

        if (!$status) {
            foreach ($dumps as $dump){
                $has = Dump::whereId($dump->id)->first();
                $hasFile = Storage::disk('storage')->exists('/dumps/'.$dump->file_name);
                \Log::info([$has, $hasFile]);
                if(!$has && $hasFile) {
                    Dump::create([
                        'file' => $dump->file,
                        'file_name' => $dump->file_name,
                        'prefix' => $dump->prefix,
                        'encrypted' => $dump->encrypted,
                        'created_at' => $dump->created_at
                    ]);
                }

            }
            return 'was successfully restored.';
        }

        return 'Database restore failed.';
    }

    /**
     * @return string|Finder
     */
    protected function getAllDumps(): string|Finder
    {
        $finder = new Finder();
        $finder->files()->in($this->getDumpsPath());

        if ($finder->count() === 0) {
            return 'You haven\'t saved any dumps.';
        }

        return $finder;
    }

    protected function unCompress(string $fileName): string
    {
        $fileNameUncompressed = $this->getUncompressedFileName($fileName);
        $command = sprintf('gzip -dc %s > %s', $fileName, $fileNameUncompressed);
        if ($this->console->run($command)) {
            return 'Uncompressed of gzipped file failed.';
        }

        return $fileNameUncompressed;
    }

    protected function cleanup(string $fileName): bool
    {
        $status = true;
        $fileNameUncompressed = $this->getUncompressedFileName($fileName);
        if ($fileName !== $fileNameUncompressed) {
            $status = File::delete($fileName);
        }

        return $status;
    }

    protected function getUncompressedFileName(string $fileName): string
    {
        return preg_replace('"\.gz$"', '', $fileName);
    }

    private function lastBackupFile(): string
    {
        $finder = new Finder();
        $finder->files()->in($this->getDumpsPath());

        $lastFileName = '';

        foreach ($finder as $dump) {
            $filename = $dump->getFilename();
            $filenameWithoutExtension = $this->filenameWithoutExtension($filename);
            if ((int)$filenameWithoutExtension > (int)$this->filenameWithoutExtension($lastFileName)) {
                $lastFileName = $filename;
            }
        }

        return $lastFileName;
    }

    private function filenameWithoutExtension($filename): array|string|null
    {
        return preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
    }
}
