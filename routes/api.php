<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1/user')->name('user')->group(function () {
    Route::get('/view/{userId}', [UserController::class, 'show'])->name('.show');
    Route::post('/add', [UserController::class, 'create'])->name('.create');
    Route::post('/edit', [UserController::class, 'update'])->name('.update');
});