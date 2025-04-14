<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds to create users with different roles.
     * Uses Spatie Permission package for role management.
     */
    public function run(): void
    {
        // Create roles
        $memberRole = Role::create(['name' => 'member']);
        $librarianRole = Role::create(['name' => 'librarian']);
        $managerRole = Role::create(['name' => 'manager']);

        // Define permissions
        $permissions = [
            // Book related permissions
            'view books',
            'create books',
            'edit books',
            'delete books',

            // BookCopy related permissions
            'view book copies',
            'create book copies',
            'edit book copies',
            'delete book copies',

            // Reservation related permissions
            'view reservations',
            'create reservations',
            'edit reservations',
            'process reservations',
            'cancel reservations',

            // Checkout related permissions
            'view checkouts',
            'create checkouts',
            'process returns',
            'extend checkouts',

            // Penalty related permissions
            'view penalties',
            'create penalties',
            'process payments',
            'waive penalties',

            // Report related permissions
            'view reports',
            'generate reports',

            // User management permissions
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        // Create all permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to member role
        $memberRole->givePermissionTo([
            'view books',
            'view reservations',
            'create reservations',
            'cancel reservations',
            'view checkouts',
            'view penalties',
        ]);

        // Assign permissions to librarian role
        $librarianRole->givePermissionTo([
            'view books',
            'create books',
            'edit books',
            'view book copies',
            'create book copies',
            'edit book copies',
            'view reservations',
            'create reservations',
            'edit reservations',
            'process reservations',
            'cancel reservations',
            'view checkouts',
            'create checkouts',
            'process returns',
            'extend checkouts',
            'view penalties',
            'create penalties',
            'process payments',
            'view reports',
            'generate reports',
            'view users',
        ]);

        // Assign permissions to manager role (all permissions)
        $managerRole->givePermissionTo($permissions);

        // Create manager user (replaces the previous admin)
        $manager = User::create([
            'name' => 'Library Manager',
            'email' => 'asasiraarthur@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $manager->assignRole('manager');

        // Create librarian users
        $librarians = [
            [
                'name' => 'John Librarian',
                'email' => 'john@library.com',
            ],
            [
                'name' => 'Sarah Librarian',
                'email' => 'sarah@library.com',
            ],
        ];

        foreach ($librarians as $librarian) {
            $user = User::create([
                'name' => $librarian['name'],
                'email' => $librarian['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('librarian');
        }

        // Create regular members
        $members = [
            [
                'name' => 'Alice Member',
                'email' => 'alice@example.com',
            ],
            [
                'name' => 'Bob Member',
                'email' => 'bob@example.com',
            ],
            [
                'name' => 'Carol Member',
                'email' => 'carol@example.com',
            ],
            [
                'name' => 'Dave Member',
                'email' => 'dave@example.com',
            ],
            [
                'name' => 'Emma Member',
                'email' => 'emma@example.com',
            ],
        ];

        foreach ($members as $member) {
            $user = User::create([
                'name' => $member['name'],
                'email' => $member['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('member');
        }
    }
}
