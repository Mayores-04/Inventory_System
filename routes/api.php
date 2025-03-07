<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\AuthController;

// 🛠️ API Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// 📚 Protected Routes (Only for Authenticated Users)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // 🏫 Admin API Routes
    Route::apiResource('/admin/teachers', TeacherController::class);
    Route::apiResource('/admin/students', StudentController::class);

    // 🔑 Logout API
    Route::post('/logout', [AuthController::class, 'logout']);
});

