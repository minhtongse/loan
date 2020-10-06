<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:createDatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create mysql database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $databaseName = env('DB_DATABASE');

        DB::statement("DROP DATABASE {$databaseName}");
        DB::statement("CREATE DATABASE {$databaseName}");
    }
}
