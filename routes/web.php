<?php

use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;

// 🏠 Public Pages (UserSide)
Route::get('/', function () {
    return view('userside.welcome');
})->name('home');

Route::get('/about', function () {
    return view('userside.about');
})->name('about');

Route::get('/contact', function () {
    return view('userside.contact');
})->name('contact');

// 🔑 Authentication Routes
Route::get('/login', function () {
    return view('userside.login');
})->name('login');

Route::get('/login/admin', function () {
    return view('auth.admin-login');  
})->name('login.admin');

Route::get('/login/student', function () {
    return view('auth.student-login');  
})->name('login.student');

Route::get('/login/teacher', function () {
    return view('auth.teacher-login');  
})->name('login.teacher');

// 🏫 Admin Panel Routes (Requires Authentication)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('/admin/teachers', TeacherController::class);
    Route::resource('/admin/students', StudentController::class);
    // Route::resource('/admin/courses', CourseController::class);
});

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


// 🏫 Student Dashboard (Authenticat
