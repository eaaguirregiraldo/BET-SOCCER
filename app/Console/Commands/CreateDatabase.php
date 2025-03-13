<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class CreateDatabase extends Command
{
    protected $signature = 'db:create';
    protected $description = 'Create the database if it does not exist';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $database = Config::get('database.connections.mysql.database');
        $query = "CREATE DATABASE IF NOT EXISTS $database";
        DB::statement($query);
        $this->info("Database '$database' created or already exists.");
    }
}