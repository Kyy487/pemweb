<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// PENTING: Panggil Controller yang sudah kita edit tadi
use App\Http\Controllers\DashboardController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    
    // --- PERBAIKAN DISINI ---
    // Kita hapus logika "function() { ... }" yang lama.
    // Kita ganti agar rutenya masuk ke DashboardController function index.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // ------------------------

    // Admin-only resource routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('classes', \App\Http\Controllers\ClassController::class);
        Route::resource('subjects', \App\Http\Controllers\SubjectController::class);
        Route::resource('students', \App\Http\Controllers\StudentController::class);
        Route::resource('users', \App\Http\Controllers\UserController::class);
    });
    
    // Grades routes
    Route::resource('grades', \App\Http\Controllers\GradeController::class);
    Route::get('/grades/print/all', [\App\Http\Controllers\GradeController::class, 'print'])->name('grades.print');
    
    // Teacher grade input routes
    Route::middleware('role:teacher')->group(function () {
        Route::get('/grades/input', [\App\Http\Controllers\GradeController::class, 'showInputForm'])->name('grades.input.form');
        Route::post('/grades/store-batch', [\App\Http\Controllers\GradeController::class, 'storeGrades'])->name('grades.store.batch');
    });
    
    // Report/PDF export routes
    Route::get('/reports/student/view', [\App\Http\Controllers\ReportController::class, 'viewStudentReportOwn'])->name('report.student.view');
    Route::get('/reports/student/{studentId}/view', [\App\Http\Controllers\ReportController::class, 'viewStudentReport'])->name('report.student.detail');
    Route::get('/reports/class/{classId}/view', [\App\Http\Controllers\ReportController::class, 'viewClassReport'])->name('report.class.view');
    Route::get('/reports/all/view', [\App\Http\Controllers\ReportController::class, 'viewAllReport'])->name('report.all.view');
});

require __DIR__.'/auth.php';