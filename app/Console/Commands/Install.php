<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Install command handles installing a fresh copy of ProcessMaker.
 * If a .env file is found in the base_path(), then we will refuse to install.
 * Note: This is destructive to your database if you point to an existing database with tables.
 */
class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install and configure App';


    /**
     * Installs a fresh copy of ProcessMaker
     *
     * @return mixed If the command succeeds, true
     */
    public function handle()
    {
        $this->comment('Hola Mundo');
    }
}
