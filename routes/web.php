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
Route::get('/deny/production', [App\Http\Controllers\ProductionController::class, 'deny'])
    ->name('production.deny');
// Special Action Production
Route::get('production/accept/{id}', [App\Http\Controllers\ProductionController::class, 'accept'])
    ->name('production.acc');
Route::get('production/reject/{id}', [App\Http\Controllers\ProductionController::class, 'reject'])
    ->name('production.reject');

// Equipment
Route::resource('equipment', App\Http\Controllers\EquipmentController::class);
Route::get('/approve/equipment', [App\Http\Controllers\EquipmentController::class, 'approv'])
    ->name('equipment.approv');
Route::get('/deny/equipment', [App\Http\Controllers\EquipmentController::class, 'deny'])
    ->name('equipment.deny');
// Special Action Equipment
Route::get('equipment/accept/{id}', [App\Http\Controllers\EquipmentController::class, 'accept'])
    ->name('equipment.acc');
Route::get('equipment/reject/{id}', [App\Http\Controllers\EquipmentController::class, 'reject'])
    ->name('equipment.reject');

// Rental
Route::resource('rental', App\Http\Controllers\RentalController::class);
Route::get('/approve/rental', [App\Http\Controllers\RentalController::class, 'approv'])
    ->name('rental.approv');
Route::get('/deny/rental', [App\Http\Controllers\RentalController::class, 'deny'])
    ->name('rental.deny');
// Special Action Rental
Route::get('rental/accept/{id}', [App\Http\Controllers\RentalController::class, 'accept'])
    ->name('rental.acc');
Route::get('rental/reject/{id}', [App\Http\Controllers\RentalController::class, 'reject'])
    ->name('rental.reject');

// Vehicle
Route::resource('vehicle', App\Http\Controllers\VehicleController::class);
Route::get('/approve/vehicle', [App\Http\Controllers\VehicleController::class, 'approv'])
    ->name('vehicle.approv');
Route::get('/deny/vehicle', [App\Http\Controllers\VehicleController::class, 'deny'])
    ->name('vehicle.deny');
// Special Action Vehicle
Route::get('vehicle/accept/{id}', [App\Http\Controllers\VehicleController::class, 'accept'])
    ->name('vehicle.acc');
Route::get('vehicle/reject/{id}', [App\Http\Controllers\VehicleController::class, 'reject'])
    ->name('vehicle.reject');

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
