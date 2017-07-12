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

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//For admin departments activities
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/departments', 'Admin\DepartmentController@departments')->name('admin.departments.all');
    Route::post('/department/add', 'Admin\DepartmentController@add')->name('admin.department.add');
    Route::get('/department/view', 'Admin\DepartmentController@view')->name('admin.department.view');
    Route::post('/department/update', 'Admin\DepartmentController@update')->name('admin.department.update');
    Route::post('/department/delete', 'Admin\DepartmentController@delete')->name('admin.department.delete');

});
