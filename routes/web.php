<?php
use App\Events\FormSubmitted;


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::post('/user/login', 'Auth\LoginController@login');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/create/category', 'CategoryController@create');

Route::get('show/category', 'CategoryController@show');

Route::post('/store/category', 'CategoryController@store');
//sub
Route::get('/create/subcategory', 'SubcategoryController@create');

Route::post('/store/subcategory', 'SubcategoryController@store');
//domain
Route::get('create/domain', 'DomainController@create');

Route::post('/domain', 'DomainController@store');

Route::get('/profile', 'UserprofileController@profile');

Route::get('/upload', 'UserprofileController@userprofile');

Route::post('/uploadimg', 'UserprofileController@store');

Route::get('/name', 'UserprofileController@name');

Route::post('/update/{user}', 'UserprofileController@update_user');

Route::get('/list', 'UserprofileController@list');

Route::post('/delete/{user}', 'UserprofileController@delete');

Route::get('/users', 'UserprofileController@vue_user');

//
Route::get('/task', 'TaskController@show');

Route::post('/storage', 'TaskController@store');

Route::get('/get/task', 'TaskController@vue_task');

Route::post('delete/task/{task}', 'TaskController@destroy');

Route::post('update/task/{task}', 'TaskController@update');
//student

Route::get('/add/student', 'StudentController@add_student');

Route::post('/store/student', 'StudentController@store');

Route::get('/get/student', 'StudentController@get_student');

Route::post('/destroy/student/{student}', 'StudentController@destroy');

Route::post('/update/student/{student}', 'StudentController@update');

//counter chat
Route::get('/chats', 'ChatController@index');
Route::get('/messages', 'ChatController@fetchAllMessages');
Route::post('/messages', 'ChatController@sendMessage');

