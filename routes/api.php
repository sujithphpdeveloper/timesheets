<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AttributeController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::resource('user', UserController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('timesheet', TimesheetController::class);
    Route::resource('attribute', AttributeController::class);
});

