<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    
    Route::get('/register', function () {
        return view('register');
    })->name('register');
    
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home', [ComplaintController::class, 'index'])->name('home');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/form', function () {
        return view('form');
    })->name('form');

    Route::post('/complaint', [ComplaintController::class, 'store'])->name('complaint.store');

    Route::get('/manajemen-komplain', [AdminController::class, 'manajemen'])->name('manajemen-komplain');
    
    Route::post('/complaint/{id}/status', [AdminController::class, 'updateStatus'])->name('complaint.update-status');

    Route::get('/detail-pending', function () {
        return view('detail-pending');
    });

    Route::get('/detail-rejected', function () {
        return view('detail-rejected');
    });
});