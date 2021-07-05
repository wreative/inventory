<?php

use App\Http\Controllers\ProductionController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


// Production
Route::resource('production', ProductionController::class);
Route::get('/approve/production', [ProductionController::class, 'approv'])
    ->name('production.approv');
Route::get('/deny/production', [ProductionController::class, 'deny'])
    ->name('production.deny');
// Special Action Production
Route::get('production/accept/{id}', [ProductionController::class, 'accept'])
    ->name('production.acc');
Route::get('production/reject/{id}', [ProductionController::class, 'reject'])
    ->name('production.reject');

// Equipment
Route::resource('equipment', EquipmentController::class);
Route::get('/approve/equipment', [EquipmentController::class, 'approv'])
    ->name('equipment.approv');
Route::get('/deny/equipment', [EquipmentController::class, 'deny'])
    ->name('equipment.deny');
// Special Action Equipment
Route::get('equipment/accept/{id}', [EquipmentController::class, 'accept'])
    ->name('equipment.acc');
Route::get('equipment/reject/{id}', [EquipmentController::class, 'reject'])
    ->name('equipment.reject');

// Rental
Route::resource('rental', RentalController::class);
Route::get('/approve/rental', [RentalController::class, 'approv'])
    ->name('rental.approv');
Route::get('/deny/rental', [RentalController::class, 'deny'])
    ->name('rental.deny');
// Special Action Rental
Route::get('rental/accept/{id}', [RentalController::class, 'accept'])
    ->name('rental.acc');
Route::get('rental/reject/{id}', [RentalController::class, 'reject'])
    ->name('rental.reject');

// Vehicle
Route::resource('vehicle', VehicleController::class);
Route::get('/approve/vehicle', [VehicleController::class, 'approv'])
    ->name('vehicle.approv');
Route::get('/deny/vehicle', [VehicleController::class, 'deny'])
    ->name('vehicle.deny');
// Special Action Vehicle
Route::get('vehicle/accept/{id}', [VehicleController::class, 'accept'])
    ->name('vehicle.acc');
Route::get('vehicle/reject/{id}', [VehicleController::class, 'reject'])
    ->name('vehicle.reject');

// Room
Route::resource('room', RoomController::class)->except([
    'show'
]);;

// Print
Route::get('/print/{name}', [HomeController::class, 'printPage'])
    ->name('print');
