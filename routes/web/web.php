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

if(app()->environment('local'))
{
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
