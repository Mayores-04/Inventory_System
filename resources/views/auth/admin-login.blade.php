@extends('userside.layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Admin Login</h2>

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            {{-- Email Field --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" required 
                    class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            {{-- Password Field --}}
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" required 
                    class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>

            {{-- Login Button --}}
            <button type="submit" 
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>
        </form>

        {{-- Forgot Password --}}
        <div class="text-center mt-4">
            <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">
                Forgot Password?
            </a>
        </div>
    </div>
</div>
@endsection
