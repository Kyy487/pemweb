<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nisn', 'study_class_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function studyClass()
    {
        return $this->belongsTo(StudyClass::class, 'study_class_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id');
    }
}
