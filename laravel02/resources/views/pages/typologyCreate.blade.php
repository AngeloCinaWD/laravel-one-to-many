@extends('layouts.main-layout')

@section('content')

  <h1>New typology</h1>

  <form class="" action="{{route('typologyStore')}}" method="post">

    @csrf
    @method('post')

    <label for="name">Name:</label>
    <input type="text" name="name" value=""> <br><br>

    <label for="description">Description:</label>
    <input type="text" name="description" value=""><br><br>

    <label for="tasks[]">Tasks:</label><br><br>
    @foreach ($tasks as $task)
      <input type="checkbox" name="tasks[]" value="{{$task -> id}}"> {{$task -> title}}<br><br>
    @endforeach

    <input type="submit" name="" value="STORE">


  </form>

@endsection
