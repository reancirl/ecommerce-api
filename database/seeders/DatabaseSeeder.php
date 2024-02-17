<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
        ]);
        
        /**
         * Create admun role
         */
        $adminRole = \Spatie\Permission\Models\Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        /**
         * Create admin user
         */
        $adminUser = \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $adminUser->assignRole($adminRole);

        /**
         * Assign all permissions to admin role
         */
        $permissions = \Spatie\Permission\Models\Permission::all();
        $adminRole->givePermissionTo($permissions);
    }
}
