@extends('layouts.main-layout')

@section('content')
  <button type="button" name="button">
    <a href="{{route('taskIndex')}}">task index</a>
  </button>
  <button type="button" name="button">
    <a href="{{route('home')}}">home</a>
  </button>

  <h1>{{$task -> title}}</h1>

  Employee: <a href="{{route('employeeShow', $task -> employee -> id)}}">{{$task -> employee -> lastname}}</a> <br>
  Priority task: [{{$task -> priority}}] <br>
  Description task: {{$task -> description}}<br><br>

@endsection
