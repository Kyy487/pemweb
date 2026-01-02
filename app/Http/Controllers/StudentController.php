<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\StudyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Hanya admin yang bisa mengakses student management
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses fitur ini.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $students = Student::with(['user', 'studyClass', 'studyClass.homeroomTeacher'])->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $users = User::where('role', 'student')->whereDoesntHave('student')->get();
        $classes = StudyClass::with('homeroomTeacher')->get();
        return view('students.create', compact('users', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:students,user_id',
            'study_class_id' => 'required|exists:study_classes,id',
        ]);

        $user = User::find($request->user_id);
        
        // Cek apakah user sudah punya NISN dari tabel students (jika ada student record sebelumnya)
        // Jika tidak, gunakan format default
        $nisn = 'NISN-' . time();

        Student::create([
            'name' => $user->name,
            'nisn' => $nisn,
            'user_id' => $request->user_id,
            'study_class_id' => $request->study_class_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan ke kelas');
    }

    public function edit(Student $student)
    {
        $classes = StudyClass::with('homeroomTeacher')->get();
        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'study_class_id' => 'required|exists:study_classes,id',
        ]);

        $student->update([
            'study_class_id' => $request->study_class_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus dari kelas');
    }
}
