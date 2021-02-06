@extends('layouts.main-layout')

@section('content')
  <button type="button" name="button">
    <a href="{{route('home')}}">home</a>
  </button>

  <h1>Tasks</h1>

  <ul>
    @foreach ($tasks as $task)
      <li>
        <a href="{{route('taskShow', $task -> id)}}">{{$task -> title}}</a>

        ({{$task -> employee -> lastname}})
      </li>
    @endforeach
  </ul>
@endsection
