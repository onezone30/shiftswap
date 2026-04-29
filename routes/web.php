<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', \App\Http\Controllers\UserController::class);

    Route::get('/dashboard',   fn() => view('dashboard'))->name('dashboard');
    Route::get('/schedule',    fn() => view('schedule.index'))->name('schedule.index');
    Route::get('/shift-swaps', fn() => view('shift-swaps.index'))->name('shift-swaps.index');
    Route::get('/staff',       fn() => view('staff.index'))->name('staff.index');
    Route::resource('branches',  \App\Http\Controllers\BranchController::class);
    Route::resource('positions', \App\Http\Controllers\PositionController::class);
    Route::get('/reports',     fn() => view('reports.index'))->name('reports.index');
});

require __DIR__.'/auth.php';
