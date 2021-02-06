@extends('layouts.main-layout')

@section('content')
  home
  <button type="button" name="button">
    <a href="{{route('employeeIndex')}}">employees index</a>
  </button>
  <button type="button" name="button">
    <a href="{{route('taskIndex')}}">tasks index</a>
  </button>
  <button type="button" name="button">
    <a href="{{route('typologyIndex')}}">typologies index</a>
  </button>
@endsection
