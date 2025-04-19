<?php

namespace App\Http\Controllers;

use App\Models\LendingFee;
use App\Models\Manager;
use App\Models\User;
use App\Notifications\UserDemotedNotification;
use App\Notifications\UserPromotedNotification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ManagerController extends Controller
{

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
    public function index()
    {
        return view('manager.dashboard');
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




    public function lendingFees(){
        //get all lending fees
        $fees = LendingFee::orderBy('duration_days', 'desc')->get();
        return view('manager.lending-fees', compact('fees'));
    }

    public function viewLendingFee(LendingFee $fee)
    {
        return view('manager.lending-fee-view', compact('fee'));
    }

    public function editLendingFee(LendingFee $fee)
    {
        return view('manager.lending-fee-edit', compact('fee'));
    }

    public function updateLendingFee(Request $request, LendingFee $fee)
    {
        // Validate the request
        $request->validate([
            'category' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'fee_amount' => 'required|numeric|min:0',
            'effective_from' => 'required|date',
            'effective_to' => 'nullable|date|after_or_equal:effective_from',
        ]);

        // Update the lending fee
        $fee->update($request->all());

        return redirect()->route('manager.lending-fees')
            ->with('success', 'Lending fee updated successfully.');
    }

}
