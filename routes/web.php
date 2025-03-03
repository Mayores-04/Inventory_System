<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // Ensure you have resources/views/welcome.blade.php
});


// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\DB;

// Route::get('/check-mongo', function () {
//     try {
//         DB::connection()->getClient()->listDatabases();
//         return response()->json(['message' => '✅ Connected to MongoDB']);
//     } catch (\Exception $e) {
//         return response()->json([
//             'error' => '❌ MongoDB Connection Error', 
//             'message' => $e->getMessage()
//         ], 500);
//     }
// });
