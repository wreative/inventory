<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes(['register' => false]);

// Users
Route::resource('users', UsersController::class)->except([
    'show',
]);

// Special Action Users
Route::get('/change-password', [ForgotPasswordController::class, 'index'])
    ->name('changePassword');
Route::post('/reset', [ForgotPasswordController::class, 'changePass'])
    ->name('changePass');
Route::post('/users/reset/{id}', [UsersController::class, 'reset'])
    ->name('users.reset');
Route::post('/users/name', [UsersController::class, 'change'])
    ->name('users.name');
