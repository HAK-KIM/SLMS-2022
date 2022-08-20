<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;

Route::get('/requests', [LeaveController::class, 'index']);
Route::post('/requests', [LeaveController::class, 'store']);
Route::put('/requests/{id}', [LeaveController::class, 'update']);
<<<<<<< HEAD

Route::get('/users', [UserController::class, 'index']);

// single users
Route::post('user/email/{id}', [UserController::class, 'storeSingleEmail'])->name('store.user.email');
=======
Route::post('/signup',[UserController::class,'signUp']);
Route::get('/signup',[UserController::class,'signUp']);
Route::post('/signin',[UserController::class,'signIn']);
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('signout',[UserController::class,'signOut']);
});
>>>>>>> 8a88f6943a2f2d8541e5aa634e330271d91edbbc

