<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;

Route::get('/grades', [GradeController::class, 'index']);
Route::post('/grades', [GradeController::class, 'store']);
Route::delete('/grades/{id}', [GradeController::class, 'destroy']);
