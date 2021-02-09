@extends('layouts.main-layout')

@section('content')
  <h1>New employee</h1>

  <form class="" action="{{route('employeeUpdate', $employee -> id)}}" method="post">
    @csrf
    @method('post')

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{$employee -> name}}"> <br><br>

    <label for="lastname">Lastname:</label>
    <input type="text" name="lastname" value="{{$employee -> lastname}}"> <br><br>

    <label for="dateOfBirth">Date of birth:</label>
    <input type="text" name="dateOfBirth" value="{{$employee -> dateOfBirth}}"> <br><br>

    <input type="submit" value="UPDATE"> <br><br>
  </form>
@endsection
