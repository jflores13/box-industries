<?php

namespace App\Console\Commands;

use App\Models\Partner;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateToMysql extends Command
{
    protected $signature = 'db:migrate-to-mysql {--force : Skip confirmation}';

    protected $description = 'Migrate data from SQLite to MySQL';

    public function handle(): int
    {
        $this->info('Starting migration from SQLite to MySQL...');

        // Get all data from SQLite
        $this->info('Exporting data from SQLite...');

        $users = User::all()->makeVisible(['password', 'remember_token'])->toArray();
        $services = Service::all()->toArray();
        $products = Product::all()->toArray();
        $partners = Partner::all()->toArray();

        $this->info('Found:');
        $this->line('  - '.count($users).' users');
        $this->line('  - '.count($services).' services');
        $this->line('  - '.count($products).' products');
        $this->line('  - '.count($partners).' partners');

        // Confirm before proceeding
        if (! $this->option('force') && ! $this->confirm('Do you want to proceed with the migration?')) {
            $this->error('Migration cancelled.');

            return 1;
        }

        // Switch to MySQL connection
        config(['database.default' => 'mysql']);

        $this->info('Running migrations on MySQL...');
        $this->call('migrate:fresh', ['--database' => 'mysql', '--force' => true]);

        // Import data to MySQL
        $this->info('Importing data to MySQL...');

        DB::connection('mysql')->transaction(function () use ($users, $services, $products, $partners) {
            // Import users
            foreach ($users as $user) {
                DB::connection('mysql')->table('users')->insert([
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'email_verified_at' => $user['email_verified_at'] ? Carbon::parse($user['email_verified_at'])->format('Y-m-d H:i:s') : null,
                    'password' => $user['password'],
                    'remember_token' => $user['remember_token'],
                    'role' => $user['role'] ?? 'user',
                    'created_at' => Carbon::parse($user['created_at'])->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::parse($user['updated_at'])->format('Y-m-d H:i:s'),
                ]);
            }
            $this->info('  ✓ Users imported');

            // Import services
            foreach ($services as $service) {
                DB::connection('mysql')->table('services')->insert([
                    'id' => $service['id'],
                    'name' => $service['name'],
                    'short_description' => $service['short_description'],
                    'long_description' => $service['long_description'],
                    'created_at' => Carbon::parse($service['created_at'])->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::parse($service['updated_at'])->format('Y-m-d H:i:s'),
                ]);
            }
            $this->info('  ✓ Services imported');

            // Import products
            foreach ($products as $product) {
                DB::connection('mysql')->table('products')->insert([
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'short_description' => $product['short_description'],
                    'long_description' => $product['long_description'],
                    'slug' => $product['slug'],
                    'button_text' => $product['button_text'],
                    'button_link' => $product['button_link'],
                    'image_src' => $product['image_src'],
                    'booklet_src' => $product['booklet_src'],
                    'product_id' => $product['product_id'],
                    'category' => $product['category'] ?? null,
                    'tags' => $product['tags'] ?? null,
                    'on_carrousel' => $product['on_carrousel'] ?? false,
                    'created_at' => Carbon::parse($product['created_at'])->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::parse($product['updated_at'])->format('Y-m-d H:i:s'),
                ]);
            }
            $this->info('  ✓ Products imported');

            // Import partners
            foreach ($partners as $partner) {
                DB::connection('mysql')->table('partners')->insert([
                    'id' => $partner['id'],
                    'image_path' => $partner['image_path'],
                    'alt_text' => $partner['alt_text'],
                    'sort_order' => $partner['sort_order'],
                    'created_at' => Carbon::parse($partner['created_at'])->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::parse($partner['updated_at'])->format('Y-m-d H:i:s'),
                ]);
            }
            $this->info('  ✓ Partners imported');
        });

        $this->info('✅ Migration completed successfully!');
        $this->line('');
        $this->warn('Next steps:');
        $this->line('1. Update your .env file: DB_CONNECTION=mysql');
        $this->line('2. Test your application');
        $this->line('3. Backup your SQLite database if needed');

        return 0;
    }
}
