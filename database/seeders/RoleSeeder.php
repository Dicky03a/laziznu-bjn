<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'manage-users',
            'manage-roles',
            'manage-permissions',
            'manage-mustahiks',
            'manage-transactions',
            'manage-programs',
            'manage-qurban',
            'manage-news',
            'manage-reports',
            'manage-settings',
            'view-dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        // Super admin gets all permissions via Gate::before in AppServiceProvider
        $superAdmin->syncPermissions(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);
        // Admin gets all permissions except manage-users
        $admin->syncPermissions(
            Permission::where('name', '!=', 'manage-users')->get()
        );

        $user = Role::firstOrCreate(['name' => 'user']);
        $user->syncPermissions([
            'view-dashboard',
        ]);
    }
}
