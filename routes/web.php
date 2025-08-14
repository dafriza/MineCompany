<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RoleManagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
$dashboardPermissionDriver = config('app.permissions')[4];
$dashboardPermissionLead = config('app.permissions')[5];
Route::get('/', [LandingPageController::class, 'index'])->name('landing_page');

Route::controller(AuthController::class)
    ->prefix('login')
    ->name('auth.')
    ->group(function () {
        Route::get('/', 'index')->name('index')->middleware('isLoged');
        Route::post('authentication', 'authentication')->name('authentication');
        Route::post('sign_out', 'signOut')->name('sign_out');
    });

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')
        ->get('/', [DashboardController::class, 'index'])
        ->name('dashboard.index');
});
