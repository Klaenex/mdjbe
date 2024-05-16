<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MdjController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect()->route('login');
});

Route::get('/inscription/{userId}/{token}', function ($userId, $token) {
    return Inertia::render('Register', ['userId' => $userId, 'token' => $token]);
})->name('register');

Route::put('/inscription', [RegisteredUserController::class, 'update'])->name('register.update');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [UserController::class, 'store']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/mdjs', [MdjController::class, 'index'])->name('mdjs.index');
    Route::get('/mdjs/{mdj}/edit', [MdjController::class, 'edit'])->name('mdjs.edit');
    Route::post('/mdjs/{mdj}/edit', [MdjController::class, 'update'])->name('mdjs.update');
    Route::delete('/mdjs/project/{id}', [MdjController::class, 'deleteProject'])->name('project.delete');
});

require __DIR__ . '/auth.php';
