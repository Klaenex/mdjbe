<?php

use App\Http\Controllers\MdjController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('dashboard', fn () => Inertia::render('Dashboard'))
    ->name('dashboard');

Route::get('profile', [UserController::class, 'editSelf'])->name('profile.edit');
Route::patch('profile', [UserController::class, 'updateSelf'])->name('profile.update');
Route::delete('profile', [UserController::class, 'destroySelf'])->name('profile.destroy');

Route::resource('users', UserController::class)->except('show');

Route::get('mdjs', [MdjController::class, 'index'])->name('mdjs.index');
Route::get('mdjs/{mdj}/edit', [MdjController::class, 'edit'])->name('mdjs.edit');
Route::post('mdjs/{mdj}', [MdjController::class, 'update'])->name('mdjs.update');
Route::delete('mdjs/project/{id}', [MdjController::class, 'deleteProject'])
    ->name('project.delete');
