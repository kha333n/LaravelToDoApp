@extends('layouts.app')
@section('title', 'Register')

@section('content')

    <form method="post" action="/login">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit">Login</button>
        <span>Don't have an account? <a href="/register">Register</a></span>
    </form>

@endsection
