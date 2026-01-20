<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

/**
 * ROUTE CONFIGURATION DENGAN ROLE-BASED ACCESS CONTROL
 * 
 * Pastikan middleware 'checkRole' sudah terdaftar di app/Http/Kernel.php
 * Penggunaan: Route::middleware(['auth', 'checkRole:admin,teacher'])->...
 */

// ============================================================
// PUBLIC ROUTES (Tidak membutuhkan autentikasi)
// ============================================================

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ============================================================
// AUTHENTICATION ROUTES (Guest only)
// ============================================================

Route::middleware('guest')->group(function () {
    Route::get('/login', 'App\Http\Controllers\Auth\AuthenticatedSessionController@create')
        ->name('login');
    Route::post('/login', 'App\Http\Controllers\Auth\AuthenticatedSessionController@store');
    
    Route::get('/register', 'App\Http\Controllers\Auth\RegisteredUserController@create')
        ->name('register');
    Route::post('/register', 'App\Http\Controllers\Auth\RegisteredUserController@store');
});

// ============================================================
// PROTECTED ROUTES (Membutuhkan autentikasi)
// ============================================================

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', 'App\Http\Controllers\Auth\AuthenticatedSessionController@destroy')
        ->name('logout');
    
    // Dashboard Universal (Redirect berdasarkan role)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

// ============================================================
// ADMIN ROUTES
// ============================================================

Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        $data = [
            'total_teachers' => \App\Models\User::where('role', 'teacher')->count(),
            'total_students' => \App\Models\Student::count(),
            'total_classes' => \App\Models\StudyClass::count(),
            'total_subjects' => \App\Models\Subject::count(),
        ];
        return view('dashboards.admin', $data);
    })->name('admin.dashboard');
    
    // User Management
    Route::resource('/users', UserController::class)
        ->names([
            'index' => 'users.index',
            'create' => 'users.create',
            'store' => 'users.store',
            'show' => 'users.show',
            'edit' => 'users.edit',
            'update' => 'users.update',
            'destroy' => 'users.destroy',
        ]);
    
    // Admin-specific routes dapat ditambahkan di sini
    // Route::resource('/settings', SettingsController::class);
    // Route::resource('/reports', AdminReportController::class);
});

// ============================================================
// TEACHER ROUTES
// ============================================================

Route::middleware(['auth', 'checkRole:teacher'])->group(function () {
    Route::get('/teacher/dashboard', function () {
        $user = auth()->user();
        $managedClass = \App\Models\StudyClass::where('homeroom_teacher_id', $user->id)->first();
        $subjects = \App\Models\Subject::all();
        
        return view('dashboards.teacher', [
            'managedClass' => $managedClass,
            'subjects' => $subjects,
        ]);
    })->name('teacher.dashboard');
    
    // Teacher-specific routes
    // Route::resource('/classes', TeacherClassController::class);
    // Route::resource('/grades', GradeController::class);
    // Route::resource('/attendance', AttendanceController::class);
});

// ============================================================
// STUDENT ROUTES
// ============================================================

Route::middleware(['auth', 'checkRole:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        $user = auth()->user();
        $studentData = \App\Models\Student::with([
            'studyClass.homeroomTeacher',
            'grades.subject'
        ])->where('user_id', $user->id)->first();
        
        return view('dashboards.student', ['studentData' => $studentData]);
    })->name('student.dashboard');
    
    // Student-specific routes
    // Route::get('/student/grades', [StudentGradeController::class, 'index']);
    // Route::get('/student/attendance', [StudentAttendanceController::class, 'index']);
    // Route::get('/student/schedule', [StudentScheduleController::class, 'index']);
});

// ============================================================
// ROUTES UNTUK MULTIPLE ROLES (Optional)
// ============================================================

Route::middleware(['auth', 'checkRole:admin,teacher'])->group(function () {
    // Routes yang bisa diakses oleh admin dan teacher
    // Route::resource('/reports', ReportController::class);
    // Route::get('/analytics', [AnalyticsController::class, 'index']);
});

Route::middleware(['auth', 'checkRole:teacher,student'])->group(function () {
    // Routes yang bisa diakses oleh teacher dan student
    // Route::get('/my-classes', [ClassController::class, 'myClasses']);
});

// ============================================================
// FALLBACK ROUTE (Untuk route yang tidak ditemukan)
// ============================================================

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
