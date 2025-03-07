<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Routing\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all()->map(function ($student) {
            return [
                'id' => (string) $student->_id,  
                'first_name' => $student->first_name,
                'last_name' => $student->last_name
            ];
        });
    
        return response()->json($students);
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);

        $student = Student::create($validated);

        return response()->json(['message' => '✅ Student added successfully!', 'data' => $student], 201);
    }

    public function viewStudent($id)
    {
        try {
            $student = Student::with('grades')->find($id);

            if (!$student) {
                return response()->json(['error' => 'Student not found'], 404);
            }

            return view('view-student', compact('student'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error fetching student: ' . $e->getMessage()); // Log the error
            return response()->json(['error' => 'Unexpected error occurred', 'details' => $e->getMessage()], 500);
        }
    }

    
}
