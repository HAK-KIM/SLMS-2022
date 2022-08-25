<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;


Route::post('/login',[UserController::class,'logIn']);

Route::middleware('auth:api')->group(function () {
    // crud leave requests
    Route::apiResource('requests', LeaveController::class);
    
    // crud student
    Route::apiResource('/students', UserController::class);

    // send mail
    Route::post('admin/email/{id}', [AdminController::class, 'storeSingleEmail'])->name('store.user.email');
    Route::post('user/email/{id}', [UserController::class, 'storeSingleEmail'])->name('store.user.email');

    // logout
    Route::post('/logout', [UserController::class, 'logout']);
});