@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <article class="text-center">
        <small>The journey of a thousand miles begins with one step <br> <i>Lao Tzu
            </i></small>
        <h5>Welcome to Tasks</h5>
        @if(\Illuminate\Support\Facades\Auth::check())
            <p>
                View your <a href="{{ url('/tasks') }}">List</a>
            </p>
        @else
            <p>
                <a href="/login">Login</a>
                Or
                <a href="/register">Register</a>
            </p>
        @endif
    </article>

@endsection
