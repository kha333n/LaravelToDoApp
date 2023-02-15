@extends('layouts.app')

@section('title', 'Edit: '. $task->title)
@section('content')
    <fieldset>
        <legend>Edit Task:</legend>
        <form method="post" action="{{ url('/tasks/update/'.$task->id) }}">
            @csrf
            @method('PUT')

            <h2>Title: </h2>
            <input type="text" name="title" value="{{ $task->title }}">

            <h2>Description: </h2>
            <textarea name="description">
            {{ $task->description }}
        </textarea>
            <input type="submit">
        </form>
    </fieldset>
    <a href="{{ url('/tasks/show/'.$task->id) }}">Cancel</a>
@endsection
