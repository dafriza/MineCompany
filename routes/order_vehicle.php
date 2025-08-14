<?php

use App\Http\Controllers\ApprovalController;
use Illuminate\Support\Facades\Route;

Route::controller(ApprovalController::class)->middleware([
    'auth',
])->prefix('order_vehicle')->name('order_vehicle.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('drivers', 'getDrivers')->name('select2.drivers');
    Route::get('vehicles', 'getVehicles')->name('select2.vehicles');
    Route::get('vehicle_companies', 'getVechicleCompanies')->name('select2.vehicle_companies');
    Route::post('store', 'store')->name('store');
});