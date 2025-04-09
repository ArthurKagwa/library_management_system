<?php

use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Redirect based on role
Route::get('/dashboard', function () {
    return auth()->user()->hasRole('manager')
        ? redirect('/manager/dashboard')
        : (auth()->user()->hasRole('librarian')
            ? redirect('/librarian/dashboard')
            : (auth()->user()->hasRole('member')
                ? redirect('/member/dashboard')
                : redirect('/')));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Role-specific dashboards
    Route::prefix('member')->group(fn () =>
    Route::get('dashboard', [MemberController::class, 'index']));

    Route::prefix('librarian')->group(fn () =>
    Route::get('dashboard', [LibrarianController::class, 'index']));

    Route::prefix('manager')->group(fn () =>
    Route::get('dashboard', [ManagerController::class, 'index']));
});

// routes/web.php
Route::middleware(['auth', 'role:librarian'])->group(function () {
    Route::get('/librarian/dashboard', [LibrarianController::class, 'index']);
});



require __DIR__.'/auth.php';
