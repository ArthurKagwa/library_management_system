<?php

namespace App\Http\Controllers;

use App\Models\BookCopy;
use App\Models\Checkout;
use App\Models\LendingFee;
use App\Models\Manager; // Unused, you can remove this.
use App\Models\User;
use App\Notifications\UserDemotedNotification;
use App\Notifications\UserPromotedNotification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Book; // Add this import
use Illuminate\Support\Facades\DB; // Add this import


class ManagerController extends Controller
{
    public function index()
    {

        $stats=[
            'total_users' => User::count(),
            'total_books' => Book::count(),
            'loanedBooks' => BookCopy::where('status', 'checked_out')->count(),
        ];

        // GET reservations for the current month
        $currentMonth = now()->format('m');
        $reservations = DB::table('reservations')
            ->whereMonth('created_at', $currentMonth)
            ->count();
        $stats['reservations'] = $reservations;
        // get checkouts for the currrent month based on checkout date
        $checkouts = Checkout::whereMonth('created_at', $currentMonth)
            ->count();
        $stats['checkouts'] = $checkouts;
        // get checkouts with with return_date set
        $checkins = Checkout::whereNotNull('return_date')
            ->whereMonth('created_at', $currentMonth)
            ->count();
        $stats['checkins'] = $checkins;


        return view('manager.dashboard', compact('stats'));
    }

    public function demote(User $user)
    {
        if (!auth()->user()->hasRole('manager')) {
            abort(403, 'Unauthorized action.');
        }
        // Get or create the librarian role
        $member = Role::firstOrCreate(['name' => 'member']);

        // Assign the role
        $user->assignRole($member);

        // Remove librarian role if exists
        if ($user->hasRole('librarian')) {
            $user->removeRole('librarian');
        }
        $user->notify(new UserDemotedNotification());
        return redirect()->route('manager.staff')
            ->with('success', "Librarian {$user->name} has been demoted.");
    }

    public static function upgradeToLibrarian(User $user)
    {
        // Verify current user is a manager
        if (!auth()->user()->hasRole('manager')) {
            abort(403, 'Unauthorized action.');
        }

        // Get or create the librarian role
        $librarianRole = Role::firstOrCreate(['name' => 'librarian']);

        // Assign the role
        if ($user->hasRole('member') && !$user->hasRole('librarian')) {
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
        $users = User::role('librarian')->with('roles')->get();
        return view('manager.staff', compact('users'));
    }


    public function lendingFees()
    {
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

    public function statistics()
    {
        // 1. Most Borrowed Books
        $mostBorrowedBooks = DB::table('borrow_logs')
            ->select('book_id', DB::raw('count(*) as borrow_count'), 'books.title')
            ->join('books', 'borrow_logs.book_id', '=', 'books.id')
            ->groupBy('book_id')
            ->orderByDesc('borrow_count')
            ->limit(5) // Limit to the top 5
            ->get();

        // 2. Number of Damaged Books (This assumes you have a 'damaged' column in your books table)
        $damagedBooksCount = Book::where('damaged', true)->count();

        // 3. Total Revenue from Lending Fees
        $totalRevenue = DB::table('borrow_logs')
            ->sum('fee_paid');

        // 4. Number of Active Borrowers
        $activeBorrowersCount = DB::table('borrow_logs')
            ->distinct('user_id')
            ->count();

        // 5. Late Returns
        $lateReturnsCount = BorrowLog::where('status', 'late')->count();


        // Pass the data to the view
        return view('manager.statistics', compact(
            'mostBorrowedBooks',
            'damagedBooksCount',
            'totalRevenue',
            'activeBorrowersCount',
            'lateReturnsCount'
        ));
    }
}

