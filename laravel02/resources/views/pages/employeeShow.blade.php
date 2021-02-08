@extends('layouts.main-layout')

@section('content')
  <button type="button" name="button">
    <a href="{{route('employeeIndex')}}">employee index</a>
  </button>
  <button type="button" name="button">
    <a href="{{route('home')}}">home</a>
  </button>

  <h1>{{$employee -> name}} {{$employee -> lastname}}</h1>

  <h3>Employee id: {{$employee -> id}}</h3>

  <h2>Tasks:</h2>

  <ul>
    @foreach ($employee -> tasks as $task)
      <li>
        Task: {{$task -> title}} <br>
        Description: {{$task -> description}}<br>
        Priority: [{{$task -> priority}}]<br>
        Employee: {{$task -> employee -> lastname}}<br><br>
      </li>

    @endforeach
  </ul>
@endsection
