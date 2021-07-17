<?php

namespace App\Actions\DB\Class;

use Illuminate\Support\Facades\Config;

trait Base
{
    /**
     * @var DatabaseBuilder
     */
    protected DatabaseBuilder $databaseBuilder;
    /**
     * @var Console
     */
    protected Console $console;

    /**
     * @var ConsoleColors
     */
    protected ConsoleColors $colors;

    /**
     * @param DatabaseBuilder $databaseBuilder
     * @return void
     */
    public function __construct(DatabaseBuilder $databaseBuilder)
    {
        $this->databaseBuilder = $databaseBuilder;
        $this->colors = new ConsoleColors();
        $this->console = new Console();
    }

    public function getDatabase($database): DatabaseContract
    {
        $database = $database ?: Config::get('database.default');
        $realConfig = Config::get('database.connections.' . $database);

        return $this->databaseBuilder->getDatabase($realConfig);
    }

    /**
     * @return string
     */
    protected function getDumpsPath(): string
    {
        return Config::get('backup.path');
    }

    public function enableCompression()
    {
        Config::set('backup.compress', true);
    }

    public function disableCompression()
    {
        Config::set('backup.compress', false);
    }

    /**
     * @return boolean
     */
    public function isCompressionEnabled(): bool
    {
        return Config::get('backup.compress');
    }

    public function isCompressed($fileName): bool
    {
        return pathinfo($fileName, PATHINFO_EXTENSION) === "gz";
    }
}
