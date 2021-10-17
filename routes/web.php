<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Badcow\PhraseGenerator\PhraseGenerator;
use Illuminate\Support\Facades\Route;

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
        Route::post('{task}/create-project', [TaskController::class, 'doCreateProject'])->name('createProject');
        Route::get('{task}/analytics', [TaskController::class, 'analytics'])->name('analytics')->middleware('can:view,task');
    });

    Route::group(['prefix' => '{course}/groups', 'as' => 'groups.'], function() {
        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::post('/', [GroupController::class, 'create'])->name('create');
    });
});

Route::group(['prefix' => 'projects', 'as' => 'projects.', 'middleware' => ['auth']], function ()
{
    Route::get('{project}/builds', [ProjectController::class, 'builds'])->middleware('can:view,project');
    Route::get('{project}/reset', [ProjectController::class, 'reset'])->middleware('can:view,project');
});

Route::get('random-name', function() {
    return PhraseGenerator::generate();
})->middleware('auth');
