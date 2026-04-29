<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',   fn() => view('dashboard'))->name('dashboard');
    Route::get('/schedule',    fn() => view('schedule.index'))->name('schedule.index');
    Route::get('/shift-swaps', fn() => view('shift-swaps.index'))->name('shift-swaps.index');
    Route::get('/staff',       fn() => view('staff.index'))->name('staff.index');
    Route::get('/branches',   [\App\Http\Controllers\BranchController::class,  'index'])->name('branches.index');
    Route::get('/positions',  [\App\Http\Controllers\PositionController::class, 'index'])->name('positions.index');
    Route::get('/reports',     fn() => view('reports.index'))->name('reports.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::apiResource('users', \App\Http\Controllers\UserController::class);
});

require __DIR__.'/auth.php';
