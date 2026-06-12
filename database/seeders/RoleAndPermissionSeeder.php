<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'manage posts',
            'manage categories',
            'manage bookings',
            'manage users',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Define requested roles
        $roles = [
            'admin',
            'user',
            'parking owner',
            'securty gaurd',
            'Care Taker',
        ];

        $roleModels = [];
        foreach ($roles as $roleName) {
            $roleModels[$roleName] = Role::firstOrCreate(['name' => $roleName]);
        }

        // Assign permissions to admin
        $roleModels['admin']->givePermissionTo(Permission::all());

        // Assign permissions to parking owner
        $roleModels['parking owner']->givePermissionTo(['manage bookings']);

        // Assign admin role to default admin user
        $adminUser = User::where('email', 'admin@parkinghawker.com')->first();
        if ($adminUser) {
            $adminUser->assignRole($roleModels['admin']);
        }

        // Assign user role to test user
        $testUser = User::where('email', 'test@example.com')->first();
        if ($testUser) {
            $testUser->assignRole($roleModels['user']);
        }
    }
}
