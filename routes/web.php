<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

// User authentication routes (Login, Register, Logout)
Auth::routes();

// Root route redirects to login if not authenticated
Route::get('/', function () {
    return redirect('/login');
});

// User Dashboard Route - accessible only for authenticated users
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Admin Dashboard Route - accessible only for authenticated admins
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Register route (handled by default with Auth::routes() but explicitly included here)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Logout POST route (for correct logout functionality)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Home route after login
Route::get('/home', [UserController::class, 'home'])->name('home');

// Alternative home route (this appears twice; you might want to remove one)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
