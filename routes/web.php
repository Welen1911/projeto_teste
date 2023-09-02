<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index']);

Route::get('/events/create', [EventController::class, 'create']);

Route::get('/products', [EventController::class, 'products']);

Route::get('/products_teste/{id?}', [EventController::class, 'teste']);
