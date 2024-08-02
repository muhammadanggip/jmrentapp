<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\TransactionLogController;



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
Route::resource('cars', CarController::class);
Route::resource('rentals', RentalController::class)->only(['store', 'index']);
Route::post('rentals/return', [RentalController::class, 'return'])->name('rentals.return');
Route::get('transaction-logs', [TransactionLogController::class, 'index'])->name('transaction_logs.index');
Route::get('/api/get-rental-rate', [RentalController::class, 'getRentalRate']);


