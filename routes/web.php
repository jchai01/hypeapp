<?php

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

Route::get('/', 'PagesController@index');
Route::get('/home', 'HomeController@index')->name('home');

//Register link
Route::get('/iamphat', function(){
  return view('auth.register');
});

//Students
Route::resource('students', 'StudentsController');
Route::get('/createSuccess',function(){
  return view('students.success');
});

//Payments
Route::resource('payments', 'PaymentsController');

//Attendance
Route::get('/attendance/create', 'AttendanceController@create');
Route::post('/attendance', 'AttendanceController@store');
Route::get('/attendance', 'AttendanceController@index');
Route::get('/attendance/{date}', 'AttendanceController@show');
Route::delete('/attendance/{date}', 'AttendanceController@destroy');

//Get THT, private or trial student using AJAX
Route::get('/findStudentName','StudentsController@findStudentName');

//Authentication purpose, login and register
Auth::routes();
