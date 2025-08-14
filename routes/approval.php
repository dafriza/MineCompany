<?php

use App\Http\Controllers\ApprovalController;
use Illuminate\Support\Facades\Route;

$approvalPermission = config('app.permissions')[2];

Route::controller(ApprovalController::class)->middleware([
    'auth',
    'can:read_' . $approvalPermission
])->prefix('approval')->name('approval.')->group(function() use ($approvalPermission) {
    Route::get('/', 'index')->name('index');
    Route::post('store', 'store')->name('store');
});