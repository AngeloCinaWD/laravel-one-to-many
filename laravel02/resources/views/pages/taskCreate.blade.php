@extends('layouts.main-layout')

@section('content')
  <h1>New task</h1>

  <form class="" action="{{route('taskStore')}}" method="post">

    @csrf
    @method('post')

    <label for="title">Title:</label>
    <input type="text" name="title" value=""><br><br>

    <label for="description">Description:</label>
    <input type="text" name="description" value=""><br><br>

    <label for="priority">Priority:</label>
    <input type="text" name="priority" value=""><br><br>

    <label for="employee_id">Employee_id:</label>
    <select name="employee_id" value="">

      @foreach ($employees as $employee)
        <option value="{{$employee -> id}}">{{$employee -> name}} {{$employee -> lastname}}</option>
      @endforeach

    </select>
    <br><br>

    <label for="typologies[]">Typologies:</label><br>
    @foreach ($typologies as $typology)
      <input type="checkbox" name="typologies[]" value="{{$typology -> id}}"> {{$typology -> name}} <br>
    @endforeach

    <br><br>
    <input type="submit" value="STORE">

  </form>
@endsection
