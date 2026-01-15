<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\StudyClass;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Grade;

class GradeController extends Controller
{
    // Display grades - berbeda berdasarkan role
    public function index(Request $request)
    {
        $user = Auth::user();
        $classId = $request->query('class_id');
        $subjectId = $request->query('subject_id');

        if ($user->role === 'admin') {
            // Admin: lihat semua nilai (opsi filter per kelas)
            $q = Grade::with(['student', 'subject', 'teacher']);
            if ($classId) {
                $q->whereHas('student', function ($q2) use ($classId) {
                    $q2->where('study_class_id', $classId);
                });
            }
            $grades = $q->paginate(15);
        } elseif ($user->role === 'teacher') {
            // Teacher: lihat nilai dari siswa di kelas mereka
            $q = Grade::with(['student', 'subject', 'teacher'])
                ->where(function($q2) use ($user) {
                    // Grades input by this teacher OR grades belonging to students in classes where
                    // the teacher is homeroom
                    $q2->where('teacher_id', $user->id)
                       ->orWhereHas('student', function($q3) use ($user) {
                            $q3->whereIn('study_class_id', StudyClass::where('homeroom_teacher_id', $user->id)->pluck('id'));
                       });
                });

            if ($classId) {
                $q->whereHas('student', function ($q2) use ($classId) {
                    $q2->where('study_class_id', $classId);
                });
            }

            $grades = $q->paginate(15);
        } else {
            // Student: lihat nilai mereka sendiri
            $student = Student::where('user_id', $user->id)->first();
            if (!$student) {
                $grades = collect();
            } else {
                $grades = Grade::where('student_id', $student->id)
                    ->with(['student', 'subject', 'teacher'])
                    ->paginate(15);
            }
        }

        // For admins and teachers, provide class & subject lists for filtering dropdowns
        $classes = null;
        $subjects = null;
        if (in_array($user->role, ['admin', 'teacher'])) {
            if ($user->role === 'admin') {
                $classes = StudyClass::all();
                $subjects = Subject::all();
            } else {
                $classes = StudyClass::where('homeroom_teacher_id', $user->id)->get();
                $classIds = $classes->pluck('id')->toArray();
                // Not all projects may have study_class_id on subjects table. Guard with Schema check.
                if (Schema::hasColumn('subjects', 'study_class_id')) {
                    $subjects = Subject::whereIn('study_class_id', $classIds)->get();
                } else {
                    // Fallback: return all subjects so filter UI still works without DB-level relation
                    $subjects = Subject::all();
                }
            }
        }

        // If class filter is present, prepare display rows to include students without grades
        $displayRows = null;
        if ($classId) {
            $students = Student::with(['grades.subject', 'grades.teacher', 'studyClass'])
                        ->where('study_class_id', $classId)
                        ->orderBy('name')
                        ->get();

            $displayRows = collect();
            foreach ($students as $student) {
                if ($subjectId) {
                    $grade = $student->grades->firstWhere('subject_id', $subjectId);
                    $score = $grade ? $grade->score : null;
                    $subject = $grade ? $grade->subject : (\App\Models\Subject::find($subjectId) ?? null);
                    $teacher = $grade ? $grade->teacher : null;
                } else {
                    $score = $student->grades->count() ? $student->grades->avg('score') : null;
                    $subject = null;
                    // pick last teacher who entered a grade if exists
                    $teacher = $student->grades->last() ? $student->grades->last()->teacher : null;
                }

                $displayRows->push((object)[
                    'student' => $student,
                    'subject' => $subject,
                    'teacher' => $teacher,
                    'score' => $score,
                ]);
            }
        }

        return view('grades.index', compact('grades', 'classes', 'subjects', 'classId', 'subjectId', 'displayRows'));
    }

    // Show create form - Admin DAN Guru diperbolehkan
    public function create()
    {
        // UBAH DISINI: Cek apakah user adalah admin ATAU teacher
        if (!in_array(Auth::user()->role, ['admin', 'teacher'])) {
            abort(403, 'Akses ditolak. Hanya admin dan guru yang dapat menambah nilai.');
        }

        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.create', compact('students', 'subjects'));
    }

    // Store new grade - Admin DAN Guru diperbolehkan
    public function store(Request $request)
    {
        // UBAH DISINI: Cek apakah user adalah admin ATAU teacher
        if (!in_array(Auth::user()->role, ['admin', 'teacher'])) {
            abort(403, 'Akses ditolak.');
        }

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'score' => 'required|integer|min:0|max:100',
        ]);

        // Add teacher_id logic
        // Jika yang login adalah guru, gunakan ID guru tersebut. 
        // Jika admin, coba ambil wali kelas, atau fallback ke ID admin.
        if (Auth::user()->role === 'teacher') {
            $validated['teacher_id'] = Auth::id();
        } else {
            $student = Student::findOrFail($validated['student_id']);
            $validated['teacher_id'] = $student->studyClass->homeroom_teacher_id ?? Auth::id();
        }

        // Jika kombinasi student_id + subject_id sudah ada, perbarui nilainya.
        $grade = Grade::updateOrCreate(
            [
                'student_id' => $validated['student_id'],
                'subject_id' => $validated['subject_id'],
            ],
            [
                'score' => $validated['score'],
                'teacher_id' => $validated['teacher_id'] ?? null,
            ]
        );

        return redirect()->route('grades.index')->with('success', 'Nilai berhasil disimpan!');
    }

    // Show edit form
    public function edit(Grade $grade)
    {
        $user = Auth::user();
        
        // Validasi akses
        if ($user->role === 'teacher') {
            // Izinkan guru mengedit, bisa diperketat jika harus wali kelas saja
            // Disini saya longgarkan sedikit agar guru mapel bisa edit (opsional)
            // Tapi kode asli Anda mengecek wali kelas, saya biarkan sesuai aslinya:
            $studentClass = $grade->student->studyClass;
            
            // Note: Jika ingin semua guru bisa edit, hapus if dibawah ini.
            // Jika ingin hanya wali kelas, biarkan. 
            // Asumsi: Guru yang menginput harusnya bisa mengedit.
            // Untuk keamanan, kita cek apakah guru yg login adalah pemilik nilai atau wali kelas
            if ($studentClass->homeroom_teacher_id !== $user->id && $grade->teacher_id !== $user->id) {
                 abort(403, 'Akses ditolak. Anda hanya dapat mengedit nilai siswa kelas Anda atau nilai yang Anda input.');
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
            // Cek apakah dia wali kelas ATAU guru yang membuat nilai tersebut
            if ($studentClass->homeroom_teacher_id !== $user->id && $grade->teacher_id !== $user->id) {
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

        // Logic teacher id tidak perlu diubah saat update agar tetap history pembuatnya
        // atau jika ingin diubah ke pengedit terakhir:
        // $validated['teacher_id'] = Auth::id(); 
        
        $grade->update($validated);

        return redirect()->route('grades.index')->with('success', 'Nilai berhasil diperbarui!');
    }

    // Delete grade
    public function destroy(Grade $grade)
    {
        $user = Auth::user();
        
        // Hanya admin yang bisa menghapus (Sesuai request asli agar tidak error kemana-mana)
        // Jika guru juga boleh menghapus, ubah kondisinya.
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
                    // Tambahkan teacher_id agar tahu siapa yang input (Guru yang sedang login)
                    'teacher_id' => Auth::id() 
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