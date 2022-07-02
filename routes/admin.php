<?php

use App\Http\Controllers\Admin\AttachPermissionToRoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetachPermissionFromRoleController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;


Route::middleware(['auth'])->group(function() {
    Route::get('dashboard',  DashboardController::class)->name('dashboard');
    Route::post('roles/attach-permission', AttachPermissionToRoleController::class)->name('roles.attach-permission');
    Route::post('roles/detach-permission', DetachPermissionFromRoleController::class)->name('roles.detach-permission');
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
});


require __DIR__.'/auth.php';