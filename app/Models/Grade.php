<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Grade extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'grades';
    protected $fillable = ['student_id', 'subject', 'grade'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
