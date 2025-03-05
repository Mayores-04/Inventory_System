<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent; 

class Grade extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'grades';
    protected $fillable = ['first_name', 'last_name', 'subject', 'grade'];
}
