<?php

use App\Http\Controllers\Api\NewsController;

// use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix'=>'news'],
    function () {

        Route::get('list', [NewsController::class, 'list']);
        Route::get('{id}', [NewsController::class, 'show']);
    }
);

// Route::middleware([])->group(function () {
//     Route::get('/news/list', [NewsController::class, 'list']);
//     Route::get('/news/{id}', [NewsController::class, 'show']);
// });
