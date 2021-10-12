<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('start', [HomeController::class, 'start'])->middleware('auth')->name('start');

Route::get('status', [HomeController::class, 'status'])->middleware('auth')->name('status');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group(['prefix' => 'courses', 'as' => 'courses.', 'middleware' => 'auth'], function ()
{
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('{course}', [CourseController::class, 'show'])->name('show');

    Route::group(['prefix' => '{course}/tasks', 'as' => 'tasks.'], function ()
    {
        Route::get('{task}', [TaskController::class, 'show'])->name('show');
    });
});

Route::group(['prefix' => 'projects', 'as' => 'projects.', 'middleware' => 'auth'], function ()
{
    Route::get('{project}/builds', [ProjectController::class, 'builds']);
});
