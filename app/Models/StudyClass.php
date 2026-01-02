<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyClass extends Model
{
    use HasFactory;

    protected $table = 'study_classes';
    protected $fillable = ['name', 'homeroom_teacher_id'];

    public function homeroomTeacher()
    {
        return $this->belongsTo(User::class, 'homeroom_teacher_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'study_class_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'study_class_id');
    }
}
