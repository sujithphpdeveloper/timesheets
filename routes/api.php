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
    // Route for Logout
    Route::post('logout', [AuthController::class, 'logout']);

    // Additional Routes for creating and updating timesheets for authenticated users based on the assigned projects
    Route::post('/project/{project}/timesheet', [TimesheetController::class, 'storeProjectTimesheet']);
    Route::put('/project/{project}/timesheet/{timesheet}', [TimesheetController::class, 'updateProjectTimesheet']);

    // Standard CRUD for each model:
    Route::resource('user', UserController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('attribute', AttributeController::class);
    Route::resource('timesheet', TimesheetController::class);


});

