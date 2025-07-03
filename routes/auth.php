<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthentificationController;
use App\Http\Controllers\Admin\DashboardController;



Route::middleware('guest')->group(function () {
    Route::get('/', [AuthentificationController::class, 'create'])->name('login');
    Route::post('/login', [AuthentificationController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AuthentificationController::class, 'destroy'])->name('logout');
});
