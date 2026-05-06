<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            SettingSeeder::class,
            PillarSeeder::class,
        ]);

        // Create Super Admin user
        $superAdmin = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password'), // You should change this later
        ]);

        $superAdmin->assignRole('super-admin');

        // Create Admin user
        $admin = User::firstOrCreate([
            'email' => 'admin1@example.com',
        ], [
            'name' => 'Admin Laziznu',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');
    }
}
