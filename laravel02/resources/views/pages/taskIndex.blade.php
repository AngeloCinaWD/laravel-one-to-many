@extends('layouts.main-layout')

@section('content')
  <button type="button" name="button">
    <a href="{{route('home')}}">home</a>
  </button>

  <h1>Tasks</h1>

  <a href="{{route('taskCreate')}}">CREATE NEW TASK</a>
  <ul>
    @foreach ($tasks as $task)
      <li>
        <a href="{{route('taskShow', $task -> id)}}">{{$task -> title}}</a>

        ({{$task -> employee -> lastname}})
        (Typologies: {{count($task -> typologies)}})

        <a href="{{route('taskEdit', $task -> id)}}">Edit</a>
      </li>
    @endforeach
  </ul>
@endsection
