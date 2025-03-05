<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        return response()->json(Grade::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'subject' => 'required|string',
            'grade' => 'required|numeric|min:0|max:100'
        ]);

        $grade = Grade::create($validated);
        return response()->json(['message' => 'Grade added successfully', 'data' => $grade], 201);
    }

    public function destroy($id)
    {
        $grade = Grade::where('_id', $id)->first();

        if (!$grade) {
            return response()->json(['error' => 'Grade not found'], 404);
        }

        $grade->delete();
        return response()->json(['message' => 'Grade deleted successfully']);
    }
}
