@extends('layouts.app')

@section('title', $task->title)
@section('content')

    <h2>{{ $task->title }} : @if($task->completed)
            <span style="color: green">Completed </span>
        @else
            <span style="color: red"> Incomplete </span>
        @endif </h2>
    <blockquote>
        <br>
        {{ $task->description }}
        <br>
        <br>
        <cite>
            Created At: {{ $task->created_at }}
            <br>
            Last Updated: {{ $task->updated_at }}
        </cite>
    </blockquote>

    <div>
        <form action="{{ url('/tasks/delete') }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <button type="submit">Delete</button>
        </form>
        <form action="{{ url('/tasks/complete') }}" method="POST" style="display: inline;">
            @csrf
            @method('PUT')
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <button type="submit">Complete</button>
        </form>
        <a href="{{ url('/tasks/edit/'.$task->id) }}">Edit</a>
        <br>
    </div>

@endsection
