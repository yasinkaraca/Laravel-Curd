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

Route::get('/', 'MainController@index');

//Route::get('list', 'MainController@index')->name('listStudents');// /{column}/{asc}

Route::get('newForm', 'MainController@newForm');

Route::post('add', 'MainController@newStudent')->name('addStudent');

Route::get('delete/{no}', 'MainController@delete')->name('deleteStudent');

Route::get('form/{no}', 'MainController@form')->name('updateForm');

Route::post('update/{no}', 'MainController@update')->name('updateStudent');

/*Route::get('cancel', function(){
    echo "cancel function";
    return redirect('/');
})->name('cancel');
Route::get('/', function () {
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/