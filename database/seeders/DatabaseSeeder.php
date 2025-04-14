<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create(['name' => 'member']);
        Role::create(['name' => 'librarian']);
        Role::create(['name' => 'manager']);
        User::factory()->create([
            'name' => 'Library Manager',
            'email' => 'asasiraarthur@gmail.com',
            'password' => bcrypt('securepassword'), // Always hash passwords!
        ])->assignRole('manager','librarian','member');
        // in DatabaseSeeder.php


    }
}
