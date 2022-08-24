<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;

// Request Route
Route::post('/requests', [LeaveController::class, 'store']);
Route::put('/requests/{id}', [LeaveController::class, 'update']);

Route::get('/users', [AdminController::class, 'index']);
Route::apiResource('/students', UserController::class);

// Public Route
Route::post('/signup',[UserController::class,'register']);
Route::post('/signin',[UserController::class,'logIn']);
// single users
Route::post('admin/email/{id}', [AdminController::class, 'storeSingleEmail'])->name('store.user.email');
Route::post('user/email/{id}', [UserController::class, 'storeSingleEmail'])->name('store.user.email');

// Private Routes
Route::post('/signup',[UserController::class,'signUp']);
Route::post('/signin',[UserController::class,'signIn']);
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('signout',[UserController::class,'lognOut']);
});
Route::get('/requests', [LeaveController::class, 'index']);
