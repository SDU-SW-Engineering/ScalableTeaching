<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTrackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GitLabOAuthController;
use App\Http\Controllers\GradingController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VSCodeController;
use App\Models\User;
use Badcow\PhraseGenerator\PhraseGenerator;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('start', [HomeController::class, 'start'])->middleware('auth')->name('start');

Route::get('status', [HomeController::class, 'status'])->middleware('auth')->name('status');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group(['prefix' => 'courses', 'as' => 'courses.', 'middleware' => 'auth'], function() {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('{course}/enroll', [CourseController::class, 'showEnroll'])->name('enroll');

    Route::group(['prefix' => '{course}', 'middleware' => ['can:view,course']], function() {
        Route::get('/', [CourseController::class, 'show'])->name('show');

        Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function() {
            Route::get('{task}', [TaskController::class, 'show'])->name('show');
            Route::get('{task}/projects/{project}', [TaskController::class, 'showProject'])->name('showProject')->middleware('can:view,project');
            Route::get('{task}/projects/{project}/download', [ProjectController::class, 'download'])->name('downloadProject')->middleware('can:download,project');
            Route::get('{task}/projects/{project}/validate', [ProjectController::class, 'validateProject'])->name('validateProject')->middleware('can:validate,project');
            Route::post('{task}/create-project', [TaskController::class, 'doCreateProject'])->name('createProject');

            Route::prefix('{task}/analytics')->as('analytics.')->controller(AnalyticsController::class)->group(function() {
                Route::get('/', 'index')->name('index')->middleware('can:view,task');
                Route::get('builds', 'builds')->name('builds')->middleware('can:view,task');
                Route::get('students', 'students')->name('students')->middleware('can:view,task');
                Route::get('pushes', 'pushes')->name('pushes')->middleware('can:view,task');
                Route::get('task-completion', 'taskCompletion')->name('taskCompletion')->middleware('can:view,task');
                Route::get('sub-tasks', 'subTasks')->name('subTasks')->middleware('can:view,task');
                Route::post('sub-tasks', 'saveSubTasks')->name('subTasks')->middleware('can:view,task');
            });
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
                ->middleware('can:respondInvite,group,groupInvitation')->where('action', 'accept|decline');
            Route::delete('{group}/invitation/{groupInvitation}', [GroupController::class, 'deleteInvite'])->name('invitations.delete')
                ->middleware('can:delete,groupInvitation');
            Route::delete('{group}/members/{user}', [GroupController::class, 'removeMember'])->name('removeMember')
                ->middleware('can:removeMember,group,user');
        });

        Route::group(['prefix' => 'grading', 'as' => 'grading.', 'middleware' => 'can:grade,course'], function() {
            Route::get('/', [GradingController::class, 'index'])->name('index');
            Route::put('users/{user}', [GradingController::class, 'updateGrading'])->name('updateGrading');
            Route::get('tasks/{task}', [GradingController::class, 'taskInfo'])->name('task-info');
            Route::post('{grade}/set-selected', [GradingController::class, 'setSelected'])->name('set-selected');
        });

        Route::group(['prefix' => 'manage', 'as' => 'manage.'], function() {
            Route::get('/', [CourseController::class, 'showManage'])->name('index')->middleware('can:manage,course');
            Route::get('tasks/create', [TaskController::class, 'showCreate'])->name('createTask')->middleware('can:manage,course');
            Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('editTask')->middleware('can:manage,course');
            Route::patch('tasks/{task}/edit', [TaskController::class, 'update'])->name('updateTask')->middleware('can:manage,course');
            Route::get('tasks/{task}/subtasks', [TaskController::class, 'subtasks'])->name('subtasks')->middleware('can:manage,course');
            Route::post('tasks/{task}/subtasks', [TaskController::class, 'updateSubtasks'])->name('updateSubtasks')->middleware('can:manage,course');
            Route::get('tasks/{task}/toggle-visibility', [TaskController::class, 'toggleVisibility'])->name('toggleVisibility')->middleware('can:manage,course');
            Route::get('tasks/{task}/refresh-readme', [TaskController::class, 'refreshReadme'])->name('refreshReadme')->middleware('can:manage,course');
            Route::post('tasks', [TaskController::class, 'store'])->name('storeTask')->middleware('can:manage,course');
            Route::post('add-teacher', [CourseController::class, 'addTeacher'])->name('addTeacher')->middleware('can:manage,course');
            Route::get('teachers/{teacher}/remove', [CourseController::class, 'removeTeacher'])->name('removeTeacher')->middleware('can:manage,course');
        });
    });
});


Route::prefix('surveys')->as('surveys.')->controller(SurveyController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('all', 'all')->name('all');
    Route::get('{survey}', 'details')->name('details');
    Route::get('{survey}/export', 'export')->name('export');
});

Route::group(['prefix' => 'projects/{project}', 'as' => 'projects.', 'middleware' => ['auth']], function() {
    Route::get('builds', [ProjectController::class, 'builds'])->middleware('can:view,project');
    Route::get('reset', [ProjectController::class, 'reset'])->middleware('can:view,project');
    Route::post('migrate/{group}', [ProjectController::class, 'migrate'])->middleware(['can:migrate,project,group', 'throttle:5']);
    Route::post('refresh-access', [ProjectController::class, 'refreshAccess'])->middleware(['can:refreshAccess,project', 'throttle:5']);

    Route::controller(SurveyController::class)->prefix('surveys/{survey}')->group(function() {
        Route::post('/', 'projectSurvey');
    });
});

Route::get('vs-code/authenticate', [VSCodeController::class, 'authenticate'])->middleware('auth');



Route::get('random-name', function() {
    return PhraseGenerator::generate();
})->middleware('auth');

if(app()->environment('local')) {
    Route::get('impersonate/{user}', function($user) {
        auth()->login(User::findOrFail($user));
        return "authed";
    });
}

Route::controller(GitLabOAuthController::class)->prefix('login')->middleware('guest')->group(function() {
    Route::get('/', 'login')->name('login');
    Route::get('callback', 'callback')->name('callback');
});


Route::get('logout', function() {
    auth()->logout();
    return redirect()->home();
});
