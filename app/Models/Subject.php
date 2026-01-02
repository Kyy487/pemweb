<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'study_class_id'];

    public function grades()
    {
        return $this->hasMany(Grade::class, 'subject_id');
    }

    public function studyClass()
    {
        return $this->belongsTo(StudyClass::class, 'study_class_id');
    }
}
