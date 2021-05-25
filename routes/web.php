<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

// Production
Route::resource('production', App\Http\Controllers\ProductionController::class);
Route::get('/approve/production', [App\Http\Controllers\ProductionController::class, 'approv'])
    ->name('production.approv');
Route::get('production/approve/{id}', [App\Http\Controllers\ProductionController::class, 'acceptAdd'])
    ->name('production.acc');

// Equipment
Route::resource('equipment', App\Http\Controllers\EquipmentClassController::class);

// 
Route::resource('student', App\Http\Controllers\StudentController::class)->except([
    'show',
]);

Route::resource('workshop', App\Http\Controllers\WorkshopController::class)->except([
    'show', 'edit'
]);

Route::resource('borrow', App\Http\Controllers\BorrowController::class)->except([
    'edit'
]);

Route::resource('history', App\Http\Controllers\HistoryController::class)->only([
    'index'
]);

Route::resource('users', App\Http\Controllers\UsersController::class)->except([
    'show',
]);

// Special Action Users
Route::get('/change-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'index'])
    ->name('changePassword');
Route::post('/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'changePass'])
    ->name('changePass');
Route::post('/users/reset/{id}', [App\Http\Controllers\UsersController::class, 'reset'])
    ->name('users.reset');
Route::post('/users/name', [App\Http\Controllers\UsersController::class, 'change'])
    ->name('users.change');
