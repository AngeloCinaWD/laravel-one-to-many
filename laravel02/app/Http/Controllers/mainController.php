<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Employee;
use App\Task;
use App\Typology;

class mainController extends Controller
{
  public function home() {
    return view('pages.home');
  }

  public function employeeIndex() {

    $employees = Employee::all();

    return view('pages.employeeIndex', compact('employees'));
  }

  public function employeeShow($id) {
    $employee = Employee::findOrFail($id);
    return view('pages.employeeShow', compact('employee'));
  }

  public function taskIndex() {
    $tasks = Task::all();
    return view('pages.taskIndex', compact('tasks'));
  }

  public function taskShow($id) {
    // dd($id);
    $task = Task::findOrFail($id);
    return view('pages.taskShow', compact('task'));
  }

  public function taskCreate() {
    $employees = Employee::all();
    $typologies = Typology::all();
    return view('pages.taskCreate', compact('employees', 'typologies'));
  }

  public function taskStore(Request $request) {
    $data = $request -> all();
    // dd($data);
    $employee = Employee::findOrFail($data['employee_id']);
    // dd($employee);
    $task = Task::make($request -> all());
    $task -> employee() -> associate($employee);
    $task -> save();

    // dd($task);

    $typologies = Typology::find($data['typologies']);
    $task -> typologies() -> attach($typologies);
    return redirect() -> route('taskIndex');
  }

  public function typologyIndex() {
    $typologies = Typology::all();
    return view('pages.typologyIndex', compact('typologies'));
  }

  public function typologyShow($id) {
    // dd($id);
    $typology = Typology::findOrFail($id);
    return view('pages.typologyShow', compact('typology'));
  }
}
