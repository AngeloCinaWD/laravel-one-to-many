@extends('layouts.main-layout')

@section('content')

<button type="button" name="button">
  <a href="{{route('home')}}">home</a>
</button> <br><br>

<a href="{{route('typologyCreate')}}">New typology</a>

<ul>
  @foreach ($typologies as $typology)
    <li>
      <a href="{{route('typologyShow', $typology -> id)}}"><h2>{{$typology -> name}} {{$typology -> lastname}}</h2></a>

      <a href="{{route('typologyEdit', $typology -> id)}}">Edit</a> <br><br>

      Tasks: {{count($typology -> tasks)}}

      {{-- <ul>
        @foreach ($employee -> tasks as $task)
          <li>
            <strong>{{$task -> title}}</strong>: {{$task -> description}}
            ({{$task -> employee -> lastname}})
          </li>
        @endforeach
      </ul> --}}
    </li>
  @endforeach
</ul>


@endsection
