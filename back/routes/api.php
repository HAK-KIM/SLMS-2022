<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LeaveController;




Route::get('/requests', [LeaveController::class, 'index']);
Route::post('/requests', [LeaveController::class, 'store']);
Route::put('/requests/{id}', [LeaveController::class, 'update']);
