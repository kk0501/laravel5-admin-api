<?php

namespace App\Console\Commands;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install the project';

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
        $this->installAdmin();
    }

    public function installAdmin()
    {
        $this->call('migrate');
        
        if (Administrator::count() == 0) {
            $this->call('db:seed', ['--class' => \Encore\Admin\Auth\Database\AdminTablesSeeder::class]);
        }
        // admin extension
        if (Menu::where('title', '=', 'Helpers')->count() == 0) {
            $this->call('admin:import', ['helpers']);
        }

        if (Menu::where('title', '=', 'Api tester')->count() == 0) {
            $this->call('admin:import', ['api-tester']);
        }

        if (Menu::where('title', '=', 'Log viwer')->count() == 0) {
            $this->call('admin:import', ['log-viewer']);
        }

        if (Menu::where('title', '=', 'Media manager')->count() == 0) {
            $this->call('admin:import', ['media-manager']);
        }

    }
}
