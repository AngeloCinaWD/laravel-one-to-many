@extends('layouts.main-layout')

@section('content')
  home
  <button type="button" name="button">
    <a href="{{route('employeeIndex')}}">employee index</a>
  </button>
  <button type="button" name="button">
    <a href="{{route('taskIndex')}}">task index</a>
  </button>
@endsection
