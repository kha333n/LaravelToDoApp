@extends('layouts.app')

@section('title', 'Create Task')
@section('content')
    <fieldset>
        <legend> New Task:</legend>
        <form method="post" action="{{ url('/tasks/store') }}">

            @csrf
            <label for="title">Title: </label><br>
            <input id="title" class="title" name="title" placeholder="On Friday">
            @error('title')
            <div>
                <small class="text-secondary"> {{ $message }}</small>
            </div>
            @enderror

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" class="description"
                      placeholder="Read Crimes and Punishment"></textarea>

            @error('description')
            <div>
                <small class="text-secondar"> {{ $message }}</small>
            </div>
            @enderror

            <input type="submit">
        </form>
    </fieldset>
@endsection
