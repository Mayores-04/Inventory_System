<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    public function run()
    {
        Grade::create([
            'student_name' => 'Alice Johnson',
            'grade' => 88
        ]);

        Grade::create([
            'student_name' => 'Bob Smith',
            'grade' => 92
        ]);
    }
}
