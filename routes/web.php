<?php

use App\Http\Controllers\{LibrarianController,
    ManagerController,
    MemberController,
    ProfileController,
    ReservationController,
  };
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication-protected routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile routes (accessible to all authenticated users)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Role-based dashboard redirection
    Route::get('/dashboard', function () {
        $user = auth()->user();

        return match(true) {
            $user->hasRole('manager') => redirect()->route('manager.dashboard'),
            $user->hasRole('librarian') => redirect()->route('librarian.dashboard'),
            $user->hasRole('member') => redirect()->route('member.dashboard'),
            default => redirect('/')
        };
    })->name('dashboard');

    // Member routes
    Route::prefix('member')->middleware('role:member')->group(function () {
        Route::get('dashboard', [MemberController::class, 'index'])->name('member.dashboard');
        Route::get('reserve-book', [MemberController::class, 'reserveBookPage'])->name('member.books.reserve');
        //view reservations
        Route::get('reservations', [MemberController::class, 'myReservations'])->name('member.my-reservations');
        //show reservation update page
        Route::get('reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('member.reservations.edit');
        //members reservation update
        Route::patch('reservations/{reservation}', [ReservationController::class, 'update'])->name('member.reservations.update');
        //to my books
        Route::get('my-books', [MemberController::class, 'myBooks'])->name('member.my-books');
    });

    // Librarian routes
    Route::prefix('librarian')->middleware('role:librarian')->group(function () {
        Route::get('dashboard', [LibrarianController::class, 'index'])->name('librarian.dashboard');
        Route::get('books', [LibrarianController::class, 'books'])->name('librarian.books');
        Route::post('delete-book', [LibrarianController::class, 'deleteBook'])->name('librarian.books.delete');

        // Reserve book routes
        Route::get('reserve-book', [LibrarianController::class, 'reserveBookPage'])->name('librarian.books.reserve');
        //view reservations
        Route::get('view-reservations', [ReservationController::class, 'index'])->name('librarian.reservations.index');
        //edit reservation
        Route::get('edit-reservation/{reservation}', [ReservationController::class, 'edit'])->name('reservations.edit');
        //update reservation
        Route::patch('update-reservation/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
        Route::get('library-books', [LibrarianController::class, 'libraryBooks'])->name('librarian.books.index');
        Route::post('library-books', [LibrarianController::class, 'storeBook'])->name('librarian.books.store');
        Route::delete('library-books/{book}', [LibrarianController::class, 'destroyBook'])->name('librarian.books.destroy');

        //to checkout page
        Route::get('checkout', [LibrarianController::class, 'checkoutPage'])->name('librarian.checkout');


    });


    // Manager routes
    Route::prefix('manager')->middleware('role:manager')->group(function () {
        Route::get('dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
        Route::get('staff', [ManagerController::class, 'staff'])->name('manager.staff');
        // Add other manager-specific routes here
        Route::post('/manager/users/{user}/upgrade', [ManagerController::class, 'upgradeToLibrarian'])->name('manager.users.upgrade');
        Route::get('staff', [ManagerController::class, 'staff'])->name('manager.staff');
        // Add other manager-specific routes here
        Route::post('/manager/users/{user}/demote', [ManagerController::class, 'demote'])->name('manager.users.demote');
    });
});

require __DIR__.'/auth.php';
