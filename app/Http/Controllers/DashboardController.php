<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\StudyClass;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Grade;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');  
        }

        $user = Auth::user();

        // --- DASHBOARD ADMIN ---
        if ($user->role === 'admin') {
            $data = [
                'total_teachers' => User::where('role', 'teacher')->count(),
                'total_students' => Student::count(),
                'total_classes' => StudyClass::count(),
                'total_subjects' => Subject::count(),
            ];
            return view('dashboards.admin', $data);

        // --- DASHBOARD GURU ---
        } elseif ($user->role === 'teacher') {
            
            // --- 1. AMBIL SEMUA KELAS (AGAR TABEL TIDAK KOSONG) ---
            // Kita pakai all() supaya semua data di database muncul, tidak peduli siapa gurunya.
            $managedClasses = StudyClass::all(); 

            // Ambil kelas spesifik wali kelas (untuk keperluan display nama jika ada)
            $managedClass = StudyClass::where('homeroom_teacher_id', $user->id)->first();
            
            // --- 2. STATISTIK ---
            $subjectsCount = Grade::where('teacher_id', $user->id)->distinct('subject_id')->count('subject_id');
            
            // Ubah hitungan agar sesuai dengan tabel (Total semua kelas di sekolah)
            $classesCount = StudyClass::count(); 
            
            $gradesCount = Grade::where('teacher_id', $user->id)->count();

            // Hitung total siswa di database
            $studentsCount = Student::count();

            // --- 3. AMBIL DATA NILAI (5 TERBARU) ---
            $recentGrades = Grade::with(['student.user', 'subject'])
                                 ->where('teacher_id', $user->id)
                                 ->latest()
                                 ->take(5)
                                 ->get();

            // --- 4. KIRIM KE VIEW ---
            $data = [
                'managedClass' => $managedClass,
                'managedClasses' => $managedClasses, // <-- ISINYA PASTI ADA (3 KELAS)
                'subjectsCount' => $subjectsCount,
                'classesCount' => $classesCount,
                'studentsCount' => $studentsCount,
                'gradesCount' => $gradesCount,
                'recentGrades' => $recentGrades,
            ];

            return view('dashboards.teacher', $data);

        // --- DASHBOARD SISWA ---
        } else { 
            $studentData = Student::with(['studyClass.homeroomTeacher', 'grades.subject'])
                                  ->where('user_id', $user->id)
                                  ->first();
            
            if (!$studentData) {
                return view('dashboards.student', ['studentData' => null]); 
            }
            
            return view('dashboards.student', compact('studentData'));
        }
    }
}