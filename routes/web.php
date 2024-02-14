<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\UserController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect()->route('login');
});
Route::get('/inscription/{userId}/{token}', function ($token, $userId) {
    return Inertia::render('register', ['token' => $token, 'userId' => $userId]);
})->name('register');
Route::put('/inscription/{userId}/{token}', [RegisteredUserController::class, 'update'])->name('register');


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
});

require __DIR__ . '/auth.php';
