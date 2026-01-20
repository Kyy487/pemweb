<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * View own student report (for student login)
     */
    public function viewStudentReportOwn()
    {
        $user = auth()->user();
        $student = Student::with(['user', 'studyClass', 'grades.subject', 'grades.teacher'])
            ->where('user_id', $user->id)
            ->firstOrFail();
        
        // Calculate statistics
        $grades = $student->grades;
        $avgGrade = $grades->count() > 0 ? $grades->avg('score') : 0;
        $totalSubjects = $grades->count();
        
        return view('reports.student-report', [
            'student' => $student,
            'grades' => $grades,
            'avgGrade' => $avgGrade,
            'totalSubjects' => $totalSubjects,
        ]);
    }

    /**
     * View student grades report (for printing as PDF - by ID)
     */
    public function viewStudentReport($studentId)
    {
        // Only allow students to view their own report
        $user = auth()->user();
        $student = Student::with(['user', 'studyClass', 'grades.subject', 'grades.teacher'])->findOrFail($studentId);
        
        // Authorization check - only admin, teacher of this student's class, or the student themselves
        if ($user->role === 'student' && $student->user_id !== $user->id) {
            abort(403, 'Unauthorized to view this report');
        }
        
        if ($user->role === 'teacher') {
            if ($student->studyClass->homeroom_teacher_id !== $user->id) {
                abort(403, 'Unauthorized to view this report');
            }
        }
        
        // Calculate statistics
        $grades = $student->grades;
        $avgGrade = $grades->count() > 0 ? $grades->avg('score') : 0;
        $totalSubjects = $grades->count();
        
        return view('reports.student-report', [
            'student' => $student,
            'grades' => $grades,
            'avgGrade' => $avgGrade,
            'totalSubjects' => $totalSubjects,
        ]);
    }

    /**
     * View class report (for printing as PDF)
     */
    public function viewClassReport($classId)
    {
        $studyClass = \App\Models\StudyClass::with(['students.grades', 'subjects', 'homeroomTeacher'])->findOrFail($classId);
        
        // Get grades per student
        $studentGrades = [];
        foreach ($studyClass->students as $student) {
            $studentGrades[$student->id] = [
                'student' => $student,
                'grades' => $student->grades,
                'avg' => $student->grades->avg('grade'),
            ];
        }

        return view('reports.class-report', [
            'studyClass' => $studyClass,
            'studentGrades' => $studentGrades,
        ]);
    }

    /**
     * View all students report (for printing as PDF)
     */
    public function viewAllReport()
    {
        $students = Student::with(['user', 'studyClass', 'grades'])->get();

        return view('reports.all-students-report', [
            'students' => $students,
        ]);
    }
}

