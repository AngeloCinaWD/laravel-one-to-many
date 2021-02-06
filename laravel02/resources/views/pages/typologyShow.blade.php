@extends('layouts.main-layout')

@section('content')
  <button type="button" name="button">
    <a href="{{route('typologyIndex')}}">typologies index</a>
  </button>
  <button type="button" name="button">
    <a href="{{route('home')}}">home</a>
  </button>

  <h1>{{$typology -> title}}</h1>

  Name: {{$typology -> name}}<br>
  Description typology: {{$typology -> description}}<br><br>

  <h1>Tasks:</h1>
  <ul>
    @foreach ($typology -> tasks as $task)
      <li>
        <a href="{{route('taskShow', $task -> id)}}">{{$task -> title}}</a>
      </li>
    @endforeach
  </ul>

@endsection
