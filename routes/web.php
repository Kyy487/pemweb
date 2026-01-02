<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\DashboardController;
// ...

// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth'])
//     ->name('dashboard');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $total_classes = \App\Models\StudyClass::count();
            $total_teachers = \App\Models\User::where('role', 'teacher')->count();
            $total_students = \App\Models\Student::count();
            $total_subjects = \App\Models\Subject::count();
            return view('dashboards.admin', compact('total_classes', 'total_teachers', 'total_students', 'total_subjects'));
        } elseif ($user->role === 'teacher') {
            return view('dashboards.teacher');
        } else {
            // Ambil data student berdasarkan user login
            $studentData = \App\Models\Student::where('user_id', $user->id)
                ->with(['studyClass.homeroomTeacher', 'grades'])
                ->first();
            return view('dashboards.student', compact('studentData'));
        }
    })->name('dashboard');

    // Admin-only resource routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('classes', \App\Http\Controllers\ClassController::class);
        Route::resource('subjects', \App\Http\Controllers\SubjectController::class);
        Route::resource('students', \App\Http\Controllers\StudentController::class);
        Route::resource('users', \App\Http\Controllers\UserController::class);
    });
    
    // Grades routes - accessible to all authenticated users but with role-based filtering
    Route::resource('grades', \App\Http\Controllers\GradeController::class);
    Route::get('/grades/print/all', [\App\Http\Controllers\GradeController::class, 'print'])->name('grades.print');
    
    // Teacher grade input routes - teachers only
    Route::middleware('role:teacher')->group(function () {
        Route::get('/grades/input', [\App\Http\Controllers\GradeController::class, 'showInputForm'])->name('grades.input.form');
        Route::post('/grades/store-batch', [\App\Http\Controllers\GradeController::class, 'storeGrades'])->name('grades.store.batch');
    });
    
    // Report/PDF export routes (printable views)
    Route::get('/reports/student/view', [\App\Http\Controllers\ReportController::class, 'viewStudentReportOwn'])->name('report.student.view');
    Route::get('/reports/student/{studentId}/view', [\App\Http\Controllers\ReportController::class, 'viewStudentReport'])->name('report.student.detail');
    Route::get('/reports/class/{classId}/view', [\App\Http\Controllers\ReportController::class, 'viewClassReport'])->name('report.class.view');
    Route::get('/reports/all/view', [\App\Http\Controllers\ReportController::class, 'viewAllReport'])->name('report.all.view');
});

require __DIR__.'/auth.php';
