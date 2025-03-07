<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Routing\Controller;


class GradeController extends Controller
{
    public function store(Request $request, $student_id)
    {
        $validated = $request->validate([
            'subject' => 'required|string',
            'grade' => 'nullable|numeric|min:0|max:100'
        ]);

        $student = Student::findOrFail($student_id);
        $validated['student_id'] = $student_id;
        $validated['grade'] = $validated['grade'] ?? "Not set";

        $grade = Grade::create($validated);
        return response()->json(['message' => '✅ Grade added successfully!', 'data' => $grade], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'subject' => 'required|string',
            'grade' => 'nullable|numeric|min:0|max:100'
        ]);

        $grade = Grade::findOrFail($id);
        $grade->update($validated);

        return response()->json(['message' => '✅ Grade updated successfully!', 'data' => $grade]);
    }

    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return response()->json(['message' => '✅ Grade deleted successfully!']);
    }
}
