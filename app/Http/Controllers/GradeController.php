<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudyClass;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Grade;

class GradeController extends Controller
{
    // Display grades - berbeda berdasarkan role
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin: lihat semua nilai
            $grades = Grade::with(['student', 'subject'])->paginate(15);
        } elseif ($user->role === 'teacher') {
            // Teacher: lihat nilai dari siswa di kelas mereka
            $grades = Grade::with(['student', 'subject'])
                ->whereHas('student', function ($query) {
                    $query->whereIn('study_class_id', 
                        StudyClass::where('homeroom_teacher_id', Auth::id())->pluck('id')
                    );
                })
                ->paginate(15);
        } else {
            // Student: lihat nilai mereka sendiri
            $student = Student::where('user_id', $user->id)->first();
            if (!$student) {
                $grades = collect();
            } else {
                $grades = Grade::where('student_id', $student->id)
                    ->with(['student', 'subject'])
                    ->paginate(15);
            }
        }

        return view('grades.index', compact('grades'));
    }

    // Show create form - hanya untuk admin
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat menambah nilai secara manual.');
        }

        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.create', compact('students', 'subjects'));
    }

    // Store new grade - hanya untuk admin
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'score' => 'required|integer|min:0|max:100',
        ]);

        // Add teacher_id from student's homeroom teacher
        $student = Student::findOrFail($validated['student_id']);
        $validated['teacher_id'] = $student->studyClass->homeroom_teacher_id ?? Auth::id();

        Grade::create($validated);

        return redirect()->route('grades.index')->with('success', 'Nilai berhasil ditambahkan!');
    }

    // Show edit form
    public function edit(Grade $grade)
    {
        $user = Auth::user();
        
        // Validasi akses
        if ($user->role === 'teacher') {
            $studentClass = $grade->student->studyClass;
            if ($studentClass->homeroom_teacher_id !== $user->id) {
                abort(403, 'Akses ditolak. Anda hanya dapat mengedit nilai siswa dari kelas Anda.');
            }
        } elseif ($user->role === 'student') {
            abort(403, 'Siswa tidak dapat mengedit nilai.');
        }

        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    // Update grade
    public function update(Request $request, Grade $grade)
    {
        $user = Auth::user();
        
        // Validasi akses
        if ($user->role === 'teacher') {
            $studentClass = $grade->student->studyClass;
            if ($studentClass->homeroom_teacher_id !== $user->id) {
                abort(403, 'Akses ditolak.');
            }
        } elseif ($user->role === 'student') {
            abort(403, 'Siswa tidak dapat mengedit nilai.');
        }

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'score' => 'required|integer|min:0|max:100',
        ]);

        // Add teacher_id from student's homeroom teacher
        $student = Student::findOrFail($validated['student_id']);
        $validated['teacher_id'] = $student->studyClass->homeroom_teacher_id ?? Auth::id();

        $grade->update($validated);

        return redirect()->route('grades.index')->with('success', 'Nilai berhasil diperbarui!');
    }

    // Delete grade
    public function destroy(Grade $grade)
    {
        $user = Auth::user();
        
        // Hanya admin yang bisa menghapus
        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat menghapus nilai.');
        }

        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Nilai berhasil dihapus!');
    }

    // 1. Menampilkan Form Pilihan Kelas & Mapel, dan Daftar Siswa
    public function showInputForm(Request $request)
    {
        // Pastikan hanya guru yang bisa mengakses
        if (Auth::user()->role !== 'teacher') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }

        $teacherId = Auth::id();
        $classId = $request->input('class_id');
        $subjectId = $request->input('subject_id');
        $students = collect(); // Inisialisasi koleksi kosong

        // Ambil semua kelas dan mapel (untuk dropdown pilihan)
        $classes = StudyClass::all();
        $subjects = Subject::all();

        // Jika Guru telah memilih Kelas dan Mapel, muat daftar siswa
        if ($classId && $subjectId) {
            $students = Student::where('study_class_id', $classId)
                               ->orderBy('name')
                               // Muat nilai yang sudah ada untuk subjek ini
                               ->with(['grades' => function($query) use ($subjectId) {
                                   $query->where('subject_id', $subjectId);
                               }])
                               ->get();
        }

        return view('grades.input_form', compact(
            'classes', 
            'subjects', 
            'students', 
            'classId', 
            'subjectId'
        ));
    }

    // 2. Menyimpan/Memperbarui Nilai Siswa
    public function storeGrades(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:study_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'grades' => 'required|array',
            'grades.*.student_id' => 'required|exists:students,id',
            'grades.*.score' => 'required|integer|min:0|max:100',
        ]);

        $subjectId = $request->input('subject_id');

        foreach ($request->grades as $gradeData) {
            $studentId = $gradeData['student_id'];
            $score = $gradeData['score'];

            // Menggunakan updateOrCreate
            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'subject_id' => $subjectId,
                ],
                [
                    'score' => $score,
                ]
            );
        }

        return redirect()->route('grades.input.form', [
            'class_id' => $request->class_id,
            'subject_id' => $subjectId
        ])->with('success', 'Semua nilai berhasil disimpan/diperbarui!');
    }

    // Print all grades
    public function print()
    {
        $grades = Grade::with(['student.user', 'subject'])->get();
        return view('grades.print', compact('grades'));
    }
}