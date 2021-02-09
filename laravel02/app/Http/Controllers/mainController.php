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

/////// Employee
  public function employeeIndex() {

    $employees = Employee::all();

    return view('pages.employeeIndex', compact('employees'));
  }

  public function employeeShow($id) {
    $employee = Employee::findOrFail($id);
    return view('pages.employeeShow', compact('employee'));
  }

  public function employeeCreate() {
    return view ('pages.employeeCreate');
  }

  public function employeeStore(Request $request) {
    // dd($request -> all());
    Employee::create($request -> all());
    return redirect() -> route('employeeIndex');
  }

  public function employeeEdit($id) {
    $employee = Employee::findOrFail($id);
    return view('pages.employeeEdit', compact('employee'));
  }

  public function employeeUpdate(Request $request, $id) {
    // dd($request -> all(), $id);
    $employee = Employee::findOrFail($id);
    $employee -> update($request -> all());
    return redirect() -> route('employeeShow', $employee -> id); 
  }

  /////// Task
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

  public function taskEdit($id) {
    $task = Task::findOrFail($id);
    $employees = Employee::all();
    $typologies = Typology::all();
    return view('pages.taskEdit', compact('employees', 'typologies', 'task'));
  }

  public function taskUpdate(Request $request, $id) {
    $data = $request -> all();
    // dd($data);
    $employee = Employee::findOrFail($data['employee_id']);
    $task = Task::findOrFail($id);
    $task -> update($data);
    $task -> employee() -> associate($employee);
    $task -> save();

    $typologies = Typology::find($data['typologies']);
    $task -> typologies() -> sync($typologies);

    return redirect() -> route('taskShow', $task -> id);
  }

/////// Typology
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
