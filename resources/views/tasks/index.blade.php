@extends('layouts.app')

@section('title', 'Tasks')
@section('content')


    <br>
    <h5>Created Tasks</h5>
    <ul>
        @foreach($tasks as $task)
            <li>
                <a href="{{ url('/tasks/show/'.$task->id) }}">{{ $task->title }}</a>
            </li>
        @endforeach
    </ul>

    <hr>

    @if($errors->any())
        <small style="color: red">
            {{$errors->first()}}
        </small>
    @endif

@endsection
