@extends('layouts.main-layout')

@section('content')

<button type="button" name="button">
  <a href="{{route('home')}}">home</a>
</button>

<ul>
  @foreach ($employees as $employee)
    <li>
      <a href="{{route('employeeShow', $employee -> id)}}"><h2>{{$employee -> name}} {{$employee -> lastname}}</h2></a>

      Tasks: {{count($employee -> tasks)}}

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
