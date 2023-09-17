<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index']);

Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');

Route::get('/events/{id}', [EventController::class, 'show']);

Route::post('/events', [EventController::class, 'store'])->middleware('auth');

Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

Route::get('/edit/{id}', [EventController::class, 'edit'])->middleware('auth');

Route::put('/update/{id}', [EventController::class, 'update'])->middleware('auth');

Route::delete('/delete/{id}', [EventController::class, 'destroy'])->middleware('auth');
