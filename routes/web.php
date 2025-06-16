<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/mdjs', [FrontendController::class, 'index'])
    ->name('mdjs.index');

Route::get('/mdjs/{mdj}', [FrontendController::class, 'show'])
    ->whereNumber('mdj')
    ->name('mdjs.show');
