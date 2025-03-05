<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;

// STUDENT ROUTES
Route::get('/students', [StudentController::class, 'index']);   
Route::get('/students/{id}', [StudentController::class, 'getStudentData']);  
Route::post('/students', [StudentController::class, 'store']);   

// GRADE ROUTES (Linked to a specific student)
Route::post('/students/{student_id}/grades', [GradeController::class, 'store']); 
Route::put('/grades/{id}', [GradeController::class, 'update']);  
Route::delete('/grades/{id}', [GradeController::class, 'destroy']);  



// Route::get('/student/{id}', [StudentController::class, 'viewStudent'])->name('student.view');
