<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class EcommerceInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecommerce:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dummy data for the Laravel E-Commerce Application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if ($this->confirm('This will delete ALL your current data and install the default dummy data. Are you sure?')) {
            File::deleteDirectory(public_path('storage/products'));
            File::deleteDirectory(public_path('storage/settings'));
            File::deleteDirectory(public_path('storage/pages'));
            File::deleteDirectory(public_path('storage/posts'));
            File::deleteDirectory(public_path('storage/users'));

            $this->callSilent('storage:link');

            $copySuccess = File::copyDirectory(public_path('images/products'), public_path('storage/products/dummy'));
            if ($copySuccess) {
                $this->info('Products images successfully copied to the storage folder.');
            }

            File::copyDirectory(public_path('images/users'), public_path('storage/users'));
            File::copyDirectory(public_path('images/pages'), public_path('storage/pages'));
            File::copyDirectory(public_path('images/posts'), public_path('storage/posts'));

            $this->call('migrate:fresh', [
                '--seed'  => true,
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'VoyagerDatabaseSeeder',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'VoyagerDummyDatabaseSeeder',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'DataTypesTableSeederCustom',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'DataRowsTableSeederCustom',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'MenusTableSeederCustom',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'MenuItemsTableSeederCustom',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'RolesTableSeederCustom',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'PermissionsTableSeederCustom',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'PermissionRoleTableSeeder',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'PermissionRoleTableSeederCustom',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'UsersTableSeederCustom',
                '--force' => true,
            ]);

            $this->call('db:seed', [
                '--class' => 'SettingsTableSeederCustom',
                '--force' => true,
            ]);

            $this->call('scout:delete-index', [
                'name' => Product::getIndexName(),
            ]);

            $this->call('scout:import');
            $this->call('scout:sync');

            $this->info('Dummy data installed.');
        }

        return 0;
    }
}
