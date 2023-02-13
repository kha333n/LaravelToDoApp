@php use Illuminate\Support\Facades\Auth; @endphp

@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <h1>
        @if(Auth::check())
            <a href="/logout">Logout</a>
        @else
            <a href="/register">Register User</a><br>
            <a href="/login">Login</a>
        @endif </h1>

@endsection
