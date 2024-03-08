<?php

use App\Modules\TodoList\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('todo-lists', Controller::class);
    Route::post('todo-lists/bulk-action', [Controller::class, 'bulkAction']);
});