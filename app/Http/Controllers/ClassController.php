<?php

namespace App\Http\Controllers;

use App\Models\StudyClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Hanya admin yang bisa mengakses class management
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
        $classes = StudyClass::with('homeroomTeacher', 'students')->get();
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'homeroom_teacher_id' => 'required|exists:users,id',
        ]);

        // Validasi bahwa homeroom_teacher adalah guru
        $teacher = User::find($request->homeroom_teacher_id);
        if (!$teacher || $teacher->role !== 'teacher') {
            return back()->withErrors(['homeroom_teacher_id' => 'Wali kelas harus memiliki role Guru.']);
        }

        StudyClass::create($request->all());
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function show(StudyClass $class)
    {
        return view('classes.show', compact('class'));
    }

    public function edit(StudyClass $class)
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('classes.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, StudyClass $class)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'homeroom_teacher_id' => 'required|exists:users,id',
        ]);

        // Validasi bahwa homeroom_teacher adalah guru
        $teacher = User::find($request->homeroom_teacher_id);
        if (!$teacher || $teacher->role !== 'teacher') {
            return back()->withErrors(['homeroom_teacher_id' => 'Wali kelas harus memiliki role Guru.']);
        }

        $class->update($request->all());
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy(StudyClass $class)
    {
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus');
    }
}

