<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseManagement\UserManagementController;
use App\Http\Controllers\CourseTrackController;
use App\Http\Controllers\GradingController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', [CourseController::class, 'index'])->name('index');
Route::get('{course}/enroll', [CourseController::class, 'showEnroll'])->name('enroll');

Route::group(['prefix' => '{course}', 'middleware' => ['can:view,course']], function() {
    Route::get('/', [CourseController::class, 'show'])->name('show');

    Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function() {
        Route::get('{task}', [TaskController::class, 'show'])->name('show');
        Route::post('{task}/mark-complete', [TaskController::class, 'markComplete'])->name('mark-complete');
        Route::get('{task}/projects/{project}', [TaskController::class, 'showProject'])->name('showProject')->middleware('can:view,project');
        Route::get('{task}/projects/{project}/download', [ProjectController::class, 'download'])->name('downloadProject')->middleware('can:download,project');
        Route::get('{task}/projects/{project}/validate', [ProjectController::class, 'validateProject'])->name('validateProject')->middleware('can:validate,project');
        Route::post('{task}/create-project', [TaskController::class, 'doCreateProject'])->name('createProject');
    });

    Route::prefix('tracks')->as('tracks.')->controller(CourseTrackController::class)->group(function() {
        Route::get('{track}', 'show')->name('show');
    });

    Route::group(['prefix' => 'groups', 'as' => 'groups.'], function() {
        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::post('/', [GroupController::class, 'create'])->name('create')->middleware('can:createGroup,course');
        Route::delete('{group}', [GroupController::class, 'destroy'])->name('destroy')->middleware('can:delete,group');
        Route::post('{group}/invite-user', [GroupController::class, 'inviteUser'])->name('invite')->middleware(['can:invite,group', 'throttle:30']);
        Route::post('{group}/leave', [GroupController::class, 'leave'])->name('leave')->middleware(['can:leave,group']);

        Route::get('{group}/invitation/{groupInvitation}/{action}', [GroupController::class, 'respondToInvite'])->name('respondInvite')
            ->can('respondInvite,group,groupInvitation')->where('action', 'accept|decline');
        Route::delete('{group}/invitation/{groupInvitation}', [GroupController::class, 'deleteInvite'])->name('invitations.delete')
            ->middleware('can:delete,groupInvitation');
        Route::delete('{group}/members/{user}', [GroupController::class, 'removeMember'])->name('removeMember')
            ->middleware('can:removeMember,group,user');
    });

    Route::group(['prefix' => 'manage', 'as' => 'manage.'], function() {
        Route::get('/', [CourseController::class, 'showManage'])->name('index')->middleware('can:manage,course');
        Route::post('tasks', [TaskController::class, 'store'])->name('storeTask')->middleware('can:manage,course');
        Route::get('roles', [UserManagementController::class, 'roles'])->name('roles');
        Route::get('tasks/create', [TaskController::class, 'showCreate'])->name('createTask')->can('manage,course');
        Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('editTask')->middleware('can:manage,course');
        Route::patch('tasks/{task}/edit', [TaskController::class, 'update'])->name('updateTask')->middleware('can:manage,course');
        Route::get('tasks/{task}/subtasks', [TaskController::class, 'subtasks'])->name('subtasks')->middleware('can:manage,course');
        Route::post('tasks/{task}/subtasks', [TaskController::class, 'updateSubtasks'])->name('updateSubtasks')->middleware('can:manage,course');
        Route::get('tasks/{task}/toggle-visibility', [TaskController::class, 'toggleVisibility'])->name('toggleVisibility')->middleware('can:manage,course');
        Route::get('tasks/{task}/refresh-readme', [TaskController::class, 'refreshReadme'])->name('refreshReadme')->middleware('can:manage,course');
        Route::post('add-teacher', [CourseController::class, 'addTeacher'])->name('addTeacher')->middleware('can:manage,course');
        Route::get('teachers/{teacher}/remove', [CourseController::class, 'removeTeacher'])->name('removeTeacher')->middleware('can:manage,course');

        Route::group(['prefix' => 'grading', 'as' => 'grading.', 'middleware' => 'can:grade,course'], function() {
            Route::get('/', [GradingController::class, 'index'])->name('index');
            Route::put('users/{user}', [GradingController::class, 'updateGrading'])->name('updateGrading');
            Route::get('tasks/{task}', [GradingController::class, 'taskInfo'])->name('task-info');
            Route::post('{grade}/set-selected', [GradingController::class, 'setSelected'])->name('set-selected');
        });

    });
});
