<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;




Route::get('/requests', [StudentController::class, 'index']);
Route::post('/requests', [StudentController::class, 'store']);
