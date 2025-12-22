@extends('layouts.master')

@section('title', 'Reset Password')

@section('content')
<h2>Reset Password</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <label>Email</label>
    <input type="email" name="email" required>
    <button type="submit">Kirim Link Reset</button>
</form>
@endsection
