<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;

Route::get('/requests', [LeaveController::class, 'index']);
Route::post('/requests', [LeaveController::class, 'store']);
Route::put('/requests/{id}', [LeaveController::class, 'update']);
Route::post('/signup',[UserController::class,'signUp']);
Route::get('/signup',[UserController::class,'signUp']);
Route::post('/signin',[UserController::class,'signIn']);
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('signout',[UserController::class,'signOut']);
});

