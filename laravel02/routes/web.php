<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'mainController@home') -> name('home');

//Employee
Route::get('/employeeIndex', 'mainController@employeeIndex') -> name('employeeIndex');

Route::get('/employeeShow/{id}', 'mainController@employeeShow') -> name('employeeShow');

Route::get('/employeeCreate', 'mainController@employeeCreate') -> name('employeeCreate');

Route::post('/employeeStore', 'mainController@employeeStore') -> name('employeeStore');

Route::get('/employeeEdit/{id}', 'mainController@employeeEdit') -> name('employeeEdit');

Route::post('/employeeUpdate/{id}', 'mainController@employeeUpdate') -> name('employeeUpdate');

//Task
Route::get('/taskIndex', 'mainController@taskIndex') -> name('taskIndex');

Route::get('/taskShow/{id}', 'mainController@taskShow') -> name('taskShow');

Route::get('/taskCreate', 'mainController@taskCreate') -> name('taskCreate');

Route::post('/taskStore', 'mainController@taskStore') -> name('taskStore');

Route::get('/taskEdit/{id}', 'mainController@taskEdit') -> name('taskEdit');

Route::post('/taskUpdate/{id}', 'mainController@taskUpdate') -> name('taskUpdate');

//Typology
Route::get('/typologyIndex', 'mainController@typologyIndex') -> name('typologyIndex');

Route::get('/typologyShow/{id}', 'mainController@typologyShow') -> name('typologyShow');

Route::get('/typologyCreate', 'mainController@typologyCreate') -> name('typologyCreate');

Route::post('/typologyStore', 'mainController@typologyStore') -> name('typologyStore');

Route::get('/typologyEdit/{id}', 'mainController@typologyEdit') -> name('typologyEdit');

Route::post('/typologyUpdate/{id}', 'mainController@typologyUpdate') -> name('typologyUpdate');
