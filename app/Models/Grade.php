<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; // Use the new package

class Grade extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'grades';
    protected $fillable = ['student_name', 'grade'];
}
