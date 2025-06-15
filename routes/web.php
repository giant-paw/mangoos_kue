<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Navigasi Login ke Home Admin
Route::get('/admin-home', function () {
    return view('admin.home-admin');
})->middleware(['auth'])->name('admin.home');

// Navigasi Login ke Home Customer
Route::get('/customer-home', function(){
    return view('home-customer');
})->middleware(['auth'])->name('customer.home');

require __DIR__.'/auth.php';
