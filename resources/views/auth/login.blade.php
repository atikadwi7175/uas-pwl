@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="card" style="max-width:400px; margin:60px auto;">
    <h2>Login</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn btn-primary" style="margin-top:15px; width:100%;">Login</button>
    </form>
</div>
@endsection
