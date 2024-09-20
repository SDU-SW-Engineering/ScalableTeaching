<?php

use App\Http\Controllers\Task\Admin\ModuleController;
use App\Http\Controllers\Task\Admin\OverviewController;
use App\Http\Controllers\Task\Admin\SettingsController;
use App\Http\Controllers\Task\Admin\StudentController;

Route::prefix('{task}')->group(function() {
    Route::prefix('admin')->as('admin.')->middleware('can:viewDashboard,task')->group(function() {

        Route::get('/', [OverviewController::class, 'index'])->name('index');

        Route::controller(StudentController::class)->group(function() {
            Route::get('students', 'students')->name('students');
            Route::get('downloads', 'downloads')->name('downloads');
            Route::get('log', 'log')->name('log');
        });

        Route::controller(ModuleController::class)->prefix('modules')->as('modules.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('install', 'install')->name('install');
            Route::get('{module}/uninstall', 'uninstall')->name('uninstall');
            Route::get('{module}/configure', 'configure')->name('configure');
            Route::post('{module}/configure', 'doConfigure')->name('do-configure');
        });


        Route::controller(SettingsController::class)->group(function() {
            Route::get('preferences', 'preferences')->name('preferences');
            Route::put('preferences', 'savePreferences')->name('preferences');
            Route::post('save-description', 'saveDescription')->name('save-description');
            Route::get('load-description-from-repo', 'loadDescription')->name('load-description');
            Route::post('update-title', 'updateTitle')->name('update-title');
            Route::post('update-duration', 'updateDuration')->name('update-duration');
            Route::post('toggle-visibility', 'toggleVisibility')->name('toggle-visibility');
            Route::post('preferences/subtasks', 'updateSubtasks')->name('updateSubtasks')->middleware('can:manage,course');
        });
    });
});

