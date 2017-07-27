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
    Route::get('/departments', 'Admin\DepartmentController@index')->name('admin.departments.all');
    Route::post('/department/add', 'Admin\DepartmentController@add')->name('admin.department.add');
    Route::get('/department/view', 'Admin\DepartmentController@view')->name('admin.department.view');
    Route::post('/department/update', 'Admin\DepartmentController@update')->name('admin.department.update');
    Route::post('/department/delete', 'Admin\DepartmentController@delete')->name('admin.department.delete');

});

//For admin teachers activities
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/teachers', 'Admin\TeacherController@index')->name('admin.teachers.all');
    Route::post('/teacher/add', 'Admin\TeacherController@add')->name('admin.teacher.add');
    Route::get('/teacher/view', 'Admin\TeacherController@view')->name('admin.teacher.view');
    Route::post('/teacher/update', 'Admin\TeacherController@update')->name('admin.teacher.update');
    Route::post('/teacher/delete', 'Admin\TeacherController@delete')->name('admin.teacher.delete');

});

//For admin courses activities
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/courses', 'Admin\CourseController@index')->name('admin.course.all');
    Route::post('/course/add', 'Admin\CourseController@add')->name('admin.course.add');
    Route::get('/course/view', 'Admin\CourseController@view')->name('admin.course.view');
    Route::post('/course/update', 'Admin\CourseController@update')->name('admin.course.update');
    Route::post('/course/delete', 'Admin\CourseController@delete')->name('admin.course.delete');

});

//For admin course assign teachers activities
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/course_assign_teacher', 'Admin\CourseAssignTeacherController@index')->name('admin.course_assign_teacher.all');
    Route::get('/ajaxTeacher','Admin\CourseAssignTeacherController@ajaxTeacher')->name('admin.course_assign_teacher.ajaxTeacher');

    Route::post('/course_assign_teacher/add', 'Admin\CourseAssignTeacherController@add')->name('admin.course_assign_teacher.add');
//    Route::get('/course/view', 'Admin\CourseController@view')->name('admin.course.view');
//    Route::post('/course/update', 'Admin\CourseController@update')->name('admin.course.update');
//    Route::post('/course/delete', 'Admin\CourseController@delete')->name('admin.course.delete');

});
