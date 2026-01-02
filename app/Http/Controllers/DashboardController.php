<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\StudyClass;
use App\Models\Subject;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->role === 'admin') {
            // ... (Kode Admin yang sudah kita buat) ...
            $data = [
                'total_teachers' => User::where('role', 'teacher')->count(),
                'total_students' => Student::count(),
                'total_classes' => StudyClass::count(),
                'total_subjects' => Subject::count(),
            ];
            return view('dashboards.admin', $data);

        } elseif ($user->role === 'teacher') {
            // ... (Kode Guru yang sudah kita buat) ...
            $managedClass = StudyClass::where('homeroom_teacher_id', $user->id)->first();
            $subjects = Subject::all(); 
            
            $data = [
                'managedClass' => $managedClass,
                'subjects' => $subjects,
            ];
            
            return view('dashboards.teacher', $data);

        } else { // Role = 'student' atau role tidak teridentifikasi
            
            // Logika Siswa
            $studentData = Student::with(['studyClass.homeroomTeacher', 'grades.subject'])
                                  ->where('user_id', $user->id)
                                  ->first();
            
            // Jika data siswa tidak ditemukan (misal user dibuat manual tanpa data student), 
            // set studentData menjadi null agar view bisa menampilkan pesan error
            if (!$studentData) {
                // Return view student, tapi data akan kosong
                return view('dashboards.student', ['studentData' => null]); 
            }
            
            return view('dashboards.student', compact('studentData')); // <-- MEMANGGIL VIEW SISWA
        }
    }
}