@extends('layouts.main-layout')

@section('content')

<ul>
  @foreach ($employees as $employee)
    <li>
      <h2>{{$employee -> name}} {{$employee -> lastname}}</h2>
      <ul>
        @foreach ($employee -> tasks as $task)
          <li>
            <strong>{{$task -> title}}</strong>: {{$task -> description}}
            ({{$task -> employee -> lastname}})
          </li>
        @endforeach
      </ul>
    </li>
  @endforeach
</ul>


@endsection
