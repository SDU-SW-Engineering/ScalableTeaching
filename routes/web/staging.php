<?php

use App\Http\Controllers\Staging\DefaultController;

Route::controller(DefaultController::class)->group(function() {
    Route::post('reset-environment', 'resetEnvironment');

    Route::get('impersonate/{user}', 'impersonate');
});;
