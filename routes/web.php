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
// Special Action Production
Route::get('production/accept/{id}', [App\Http\Controllers\ProductionController::class, 'accept'])
    ->name('production.acc');
Route::get('production/reject/{id}', [App\Http\Controllers\ProductionController::class, 'reject'])
    ->name('production.reject');

// Equipment
Route::resource('equipment', App\Http\Controllers\EquipmentController::class);
Route::get('/approve/production', [App\Http\Controllers\ProductionController::class, 'approv'])
    ->name('production.approv');
// Special Action Production
Route::get('production/accept/{id}', [App\Http\Controllers\ProductionController::class, 'accept'])
    ->name('production.acc');
Route::get('production/reject/{id}', [App\Http\Controllers\ProductionController::class, 'reject'])
    ->name('production.reject');

// Rental
Route::resource('rental', App\Http\Controllers\RentalController::class);
Route::get('/approve/production', [App\Http\Controllers\ProductionController::class, 'approv'])
    ->name('production.approv');
// Special Action Production
Route::get('production/accept/{id}', [App\Http\Controllers\ProductionController::class, 'accept'])
    ->name('production.acc');
Route::get('production/reject/{id}', [App\Http\Controllers\ProductionController::class, 'reject'])
    ->name('production.reject');

// Vehicle
Route::resource('vehicle', App\Http\Controllers\VehicleController::class);
Route::get('/approve/production', [App\Http\Controllers\ProductionController::class, 'approv'])
    ->name('production.approv');
// Special Action Production
Route::get('production/accept/{id}', [App\Http\Controllers\ProductionController::class, 'accept'])
    ->name('production.acc');
Route::get('production/reject/{id}', [App\Http\Controllers\ProductionController::class, 'reject'])
    ->name('production.reject');

// Room
Route::resource('room', App\Http\Controllers\RoomController::class)->except([
    'show'
]);;

// Users
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
    ->name('users.name');
