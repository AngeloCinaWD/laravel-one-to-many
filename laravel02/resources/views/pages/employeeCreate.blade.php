@extends('layouts.main-layout')

@section('content')
  <h1>New employee</h1>

  <form class="" action="{{route('employeeStore')}}" method="post">
    @csrf
    @method('post')

    <label for="name">Name:</label>
    <input type="text" name="name" value=""> <br><br>

    <label for="lastname">Lastname:</label>
    <input type="text" name="lastname" value=""> <br><br>

    <label for="dateOfBirth">Date of birth:</label>
    <input type="text" name="dateOfBirth" value=""> <br><br>

    <input type="submit" value="STORE"> <br><br>
  </form>
@endsection
