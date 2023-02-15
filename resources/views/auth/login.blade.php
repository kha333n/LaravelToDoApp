@extends('layouts.app')
@section('title', 'Login')

@section('content')

    <fieldset>
        <legend>Login:</legend>
        <form method="post" action="/login">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                @error('email')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                @error('password')
                <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Login</button>
            <span>Don't have an account? <a href="/register">Register</a></span>
        </form>
    </fieldset>
@endsection
