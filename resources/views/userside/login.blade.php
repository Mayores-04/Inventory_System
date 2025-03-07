@extends('userside.layouts.app')

@section('content')
<div class="text-center">
    <h1>Login</h1>
    <a href="{{ route('admin.dashboard') }}">Admin Login</a> |
    <a href="{{ route('student.dashboard') }}">Student Login</a> |
    <a href="{{ route('teacher.dashboard') }}">Teacher Login</a>
</div>
@endsection
