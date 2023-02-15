@extends('layouts.app')
@section('title', 'Register')

@section('content')

<fieldset>
    <legend>Register:</legend>
    <form method="POST" action="/register">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
            @error('name')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
            @error('email')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Register</button>
        <span>Already have account? <a href="/login">Login</a></span>
    </form>
</fieldset>
@endsection
