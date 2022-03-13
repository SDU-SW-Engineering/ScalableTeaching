<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VSCodeController;
use App\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::any('reporter', [WebhookController::class, 'reporter'])->name('reporter');

Route::get('users/search', [UserController::class, 'search'])->middleware('auth');

Route::controller(VSCodeController::class)->prefix('vs-code')->group(function() {
    Route::get('retrieve-authentication', 'retrieveAuthentication');
    Route::get('courses', 'courses')->middleware('auth:sanctum');
    Route::get('courses/{course}/tasks', 'courseTasks')->middleware('auth:sanctum');
    Route::get('courses/{course}/tasks/{task}/projects/{project}/tree', 'fileTree')->middleware('auth:sanctum');
});
