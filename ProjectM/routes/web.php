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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return "It is just for testing purpose!!!";
});

/* For Login Page */
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/projects/create/{company_id}', 'ProjectsController@create');

/*Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/

/* Without Authentication, it won't work */
Route::middleware(['auth'])->group(function(){
    Route::resource('companies', 'CompaniesController');
    Route::get('/projects/create/{company_id?}', 'ProjectsController@create');
    Route::post('/projects/adduser', 'ProjectsController@addUser')->name('projects.addUser');
    Route::resource('projects', 'ProjectsController');
    Route::resource('roles', 'RolesController');
    Route::resource('tasks', 'TasksController');
    Route::resource('users', 'UsersController');
    Route::resource('comments', 'CommentsController');
});