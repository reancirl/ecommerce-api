<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read stores']);
        Permission::create(['name' => 'create stores']);
        Permission::create(['name' => 'read product types']);
        Permission::create(['name' => 'create product types']);
        Permission::create(['name' => 'read categories']);
        Permission::create(['name' => 'create categories']);
    }
}
