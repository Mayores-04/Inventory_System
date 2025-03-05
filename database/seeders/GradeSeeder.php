<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    public function run()
    {
        Grade::create([
            'first_name' => 'Alice Johnson',
            'last_name' => 'Alice Johnson',
            'subject' => 'CP1',
            'grade' => 88
        ]);

        Grade::create([
            'first_name' => 'Alice Johnson',
            'last_name' => 'Alice Johnson',
            'subject' => 'CP2',
            'grade' => 88
        ]);
    }
}
