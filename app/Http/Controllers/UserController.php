<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\StudyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Hanya admin yang bisa mengakses user management
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
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $classes = StudyClass::all();
        return view('users.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:admin,teacher,student',
            'study_class_id' => 'nullable|required_if:role,student|exists:study_classes,id',
            'nisn' => 'nullable|required_if:role,student|string|max:20|unique:students',
        ]);

        // Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Jika role adalah student, buat record Student
        if ($request->role === 'student') {
            Student::create([
                'name' => $request->name,
                'nisn' => $request->nisn,
                'user_id' => $user->id,
                'study_class_id' => $request->study_class_id,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $classes = StudyClass::all();
        $student = Student::where('user_id', $user->id)->first();
        return view('users.edit', compact('user', 'classes', 'student'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:6',
            'role' => 'required|in:admin,teacher,student',
            'study_class_id' => 'nullable|required_if:role,student|exists:study_classes,id',
            'nisn' => 'nullable|required_if:role,student|string|max:20|unique:students,nisn,' . ($user->id ? \App\Models\Student::where('user_id', $user->id)->value('id') : 'NULL'),
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Handle Student record
        if ($request->role === 'student') {
            $student = Student::where('user_id', $user->id)->first();
            if ($student) {
                $student->update([
                    'name' => $request->name,
                    'nisn' => $request->nisn,
                    'study_class_id' => $request->study_class_id,
                ]);
            } else {
                Student::create([
                    'name' => $request->name,
                    'nisn' => $request->nisn,
                    'user_id' => $user->id,
                    'study_class_id' => $request->study_class_id,
                ]);
            }
        } else {
            // Hapus Student record jika user diubah ke non-student
            Student::where('user_id', $user->id)->delete();
        }

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        // Hapus Student record jika ada
        Student::where('user_id', $user->id)->delete();
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus');
    }
}

