<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class Student extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'students'; 
    protected $fillable = ['first_name', 'last_name'];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
