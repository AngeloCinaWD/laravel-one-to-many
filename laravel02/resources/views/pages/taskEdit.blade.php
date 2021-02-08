@extends('layouts.main-layout')

@section('content')
  <h1>Edit task</h1>

  <form class="" action="{{route('taskUpdate', $task -> id)}}" method="post">

    @csrf
    @method('post')

    <label for="title">Title:</label>
    <input type="text" name="title" value="{{$task -> title}}"><br><br>

    <label for="description">Description:</label>
    <input type="text" name="description" value="{{$task -> description}}"><br><br>

    <label for="priority">Priority:</label>
    <input type="text" name="priority" value="{{$task -> priority}}"><br><br>

    <label for="employee_id">Employee_id:</label>
    <select name="employee_id" value="">

      @foreach ($employees as $employee)
        <option value="{{$employee -> id}}"
          @if ($task -> employee -> id == $employee -> id)
            selected
          @endif
        >{{$employee -> name}} {{$employee -> lastname}}</option>
      @endforeach

    </select>
    <br><br>

    <label for="typologies[]">Typologies:</label><br>
    @foreach ($typologies as $typology)
      <input type="checkbox" name="typologies[]" value="{{$typology -> id}}"

      @if ($task -> typologies -> contains($typology -> id))
        checked
      @endif
      {{-- @foreach ($task -> typologies as $task_typology)
        @if ($task_typology -> id == $typology -> id)
          checked
        @endif
      @endforeach --}}
      > {{$typology -> name}} <br>
    @endforeach
    <br><br>
    <input type="submit" value="UPDATE">

  </form>
@endsection
