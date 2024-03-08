<?php

use App\Modules\TestModule\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('test-modules', Controller::class);
    Route::post('test-modules/bulk-action', [Controller::class, 'bulkAction']);
});