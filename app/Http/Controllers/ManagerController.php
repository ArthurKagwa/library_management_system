<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\User;
use App\Notifications\UserDemotedNotification;
use App\Notifications\UserPromotedNotification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manager.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function demote (User $user)
    {
        if (!auth()->user()->hasRole('manager')) {
            abort(403, 'Unauthorized action.');
        }
        // Get or create the librarian role
        $member = Role::firstOrCreate(['name' => 'member']);

        // Assign the role
        $user->assignRole($member);

        // Remove member role if exists
        if ($user->hasRole('librarian')) {
            $user->removeRole('librarian');
        }
        $user->notify(new UserDemotedNotification());
        return redirect()->route('manager.staff')
            ->with('success', "Librarian {$user->name} has been demoted.");

    }

    public function upgradeToLibrarian(Request $request, User $user)
    {
        // Verify current user is a manager
        if (!auth()->user()->hasRole('manager')) {
            abort(403, 'Unauthorized action.');
        }

        // Get or create the librarian role
        $librarianRole = Role::firstOrCreate(['name' => 'librarian']);

        // Assign the role
        if ($user->hasRole('member')&& !$user->hasRole('librarian')) {
            $user->assignRole($librarianRole);
        }

        $user->notify(new UserPromotedNotification());

        return redirect()->route('manager.staff')
            ->with('success', "User {$user->name} has been upgraded to librarian.");
    }
    // app/Http/Controllers/ManagerController.php
    public function staff()
    {
        // Get all users with their roles
        $users = User::with('roles')->get();

        return view('manager.staff', compact('users'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {
        //
    }
}
