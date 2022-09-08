<?php

use App\Http\Controllers\Task\Admin\GradingController;
use App\Http\Controllers\Task\Admin\OverviewController;
use App\Http\Controllers\Task\Admin\ProgressionController;
use App\Http\Controllers\Task\Admin\SettingsController;
use App\Http\Controllers\Task\Admin\StudentController;

Route::prefix('{task}')->group(function() {
    Route::prefix('admin')->as('admin.')->middleware('can:viewDashboard,task')->group(function() {

        Route::get('/', [OverviewController::class, 'index'])->name('index');

        Route::controller(StudentController::class)->group(function() {
            Route::get('students', 'students')->name('students');
            Route::get('builds', 'builds')->name('builds');
            Route::get('pushes', 'pushes')->name('pushes');
            Route::get('downloads', 'downloads')->name('downloads');
            Route::get('log', 'log')->name('log');
        });

        Route::controller(ProgressionController::class)->group(function() {
            Route::get('task-completion', 'taskCompletion')->name('taskCompletion');
            Route::get('sub-tasks', 'subTasks')->name('subTasks');
            Route::post('sub-tasks', 'saveSubTasks')->name('subTasks');
        });

        Route::controller(GradingController::class)->group(function() {
            Route::get('grading-overview', 'gradingOverview')->name('gradingOverview');
            Route::get('grading-delegate', 'gradingDelegate')->name('gradingDelegate');
            Route::post('grading-delegate', 'addDelegation')->name('addDelegation');
            Route::delete('grading-delegate', 'removeDelegation')->name('removeDelegation');
        });

        Route::controller(SettingsController::class)->group(function() {
            Route::get('preferences', 'preferences')->name('preferences');
            Route::post('save-description', 'saveDescription')->name('save-description');
            Route::post('update-title', 'updateTitle')->name('update-title');
            Route::post('update-duration', 'updateDuration')->name('update-duration');
            Route::post('toggle-visibility', 'toggleVisibility')->name('toggle-visibility');
        });
    });
});

