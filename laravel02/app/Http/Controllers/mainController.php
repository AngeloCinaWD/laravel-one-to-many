<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Employee;
use App\Task;
use App\Typology;

class mainController extends Controller
{

  protected $baseValidation = [ // posso farmi una proprietà con array contenente i campi da validare
    'title' => 'required|string|min:5|max:255',
    'description' => 'required|string|min:10',
    'priority' => 'required|integer',
    'typologies' => 'required' // costringo l'utente a selezionare almeno una typology
  ];

  protected function personalPriority($priority) { // funzione per la validation custo del campo priority, ritorna vero se il numero inserito è compreso fra 1 e 5
    return $priority >=1 && $priority <= 5;
  }

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
    // $data = $request -> all();
    // dd($data);

    // $data = $request->validate([ //senza proprietà con array contenente i campi da validare
    //   'title' => 'required|string|min:5|max:255',
    //   'description' => 'required|string|min:10',
    //   'priority' => 'required|integer',
    //   'typologies' => 'required'
    // ]);

    $data = $request->validate($this -> baseValidation); // richiamo la proprietà con i campi da validare

    // if ($data['priority'] < 1 || $data['priority'] > 5) { // priority custom senza richiamare la funzione
    //   return redirect() -> back() -> withErrors(['priority' => 'out of range']);
    // }

    if (!$this-> personalPriority($data['priority'])) { // priority custom con richiamo funzione personalPriority con notOperator perchè se il numero passato non è compreso fra 1 e 5 la funzione restituisce falso che con il not operator diventa vero e quindi mi entra nell'if block e mi lancia il messaggio di errore
      return redirect() -> back() -> withErrors(['priority' => 'out of range']);
    }

    // $employee = Employee::findOrFail($data['employee_id']);
    $employee = Employee::findOrFail($request -> get('employee_id')); // dato che nella validate non sto validando employee_id metto $request -> get()
    // dd($employee);
    $task = Task::make($request -> all());
    $task -> employee() -> associate($employee);
    $task -> save();

    // dd($task);

    // $typologies = Typology::find($data['typologies']);
    $typologies = Typology::find($request -> get('typologies'));
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

    if (array_key_exists('typologies', $data)) {
      $typologies = Typology::find($data['typologies']);
    } else {
      $typologies = [];
    }

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

    Validator::make($data, [
      'name' => 'required|min:5|max:15',
      'description' => 'required|min:5|max:20'
    ]) -> validate();

    $typology = Typology::findOrFail($id);
    $typology -> update($data);

    if (array_key_exists('tasks', $data)) {
      $tasks = Task::findOrFail($data['tasks']);
    } else {
      $tasks = [];
    }

    $typology -> tasks() -> sync($tasks);

    return redirect() -> route('typologyShow', $typology -> id);
  }
}
