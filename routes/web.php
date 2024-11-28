<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DataController::class,'showAllMovie']);
Route::get('/insert', [DataController::class,'showAllGenre']);
Route::post('/insertMovie', [DataController::class,'insertMovie']);
Route::delete('/deleteMovie/{id}', [DataController::class,'deleteMovie']);