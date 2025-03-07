@extends('userside.layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-blue-600 mb-4">Welcome to Our School Management System</h1>
        <p class="text-gray-700 text-lg mb-6">Empowering education with technology.</p>

        <div class="space-x-4">
            <a href="{{ route('admin.login') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-700">
                Admin Login
            </a>
            <a href="{{ route('login.student') }}" class="px-6 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700">
                Student Login
            </a>
            <a href="{{ route('login.teacher') }}" class="px-6 py-3 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-700">
                Teacher Login
            </a>
        </div>
    </div>
</div>
@endsection