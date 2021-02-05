<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Employee;

class mainController extends Controller
{
  public function home() {
    return view('pages.home');
  }

  public function employeeIndex() {

    $employees = Employee::all();

    return view('pages.employeeIndex', compact('employees'));
  }
}
