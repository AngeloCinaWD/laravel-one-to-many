<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    Validator::make($request -> all(), [
      'name' => 'required|min:5',
      'lastname' => 'required|min:5',
    ]) -> validate();

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

  public function typologyCreate() {
    $tasks = Task::all();
    return view('pages.typologyCreate', compact('tasks'));
  }

  public function typologyStore(Request $request) {
    $data = $request -> all();
    // dd($data);
    $typology = Typology::create($request -> all());
    $tasks = Task::findOrFail($data['tasks']);
    $typology -> tasks() -> attach($tasks);
    return redirect() -> route('typologyIndex');
  }

  public function typologyEdit($id) {
    $tasks = Task::all();
    $typology = Typology::findOrFail($id);
    return view('pages.typologyEdit', compact('tasks', 'typology'));
  }

  public function typologyUpdate(Request $request, $id) {
    $data = $request -> all();
    // dd($data, $id);

    $typology = Typology::findOrFail($id);
    $typology -> update($data);

    $tasks = Task::findOrFail($data['tasks']);
    $typology -> tasks() -> sync($tasks);

    return redirect() -> route('typologyShow', $typology -> id);
  }
}
