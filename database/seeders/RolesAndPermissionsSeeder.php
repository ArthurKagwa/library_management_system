<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create the 'member' role
         Role::create(['name' => 'member', 'guard_name' => 'web']);
        
         // Optional: Create other roles (admin, etc.)
         Role::create(['name' => 'admin', 'guard_name' => 'web']);
    }
}
