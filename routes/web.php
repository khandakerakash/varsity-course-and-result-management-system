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

use App\Teacher;

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
    Route::get('/ajaxTeacherCourse','Admin\CourseAssignTeacherController@ajaxTeacherCourse')->name('admin.course_assign_teacher.ajaxTeacherCourse');
    Route::get('/ajaxTeacherCredit/{id}','Admin\CourseAssignTeacherController@ajaxTeacherCredit')->name('admin.course_assign_teacher.ajaxTeacherCredit');
    Route::get('/ajaxCourseName/{id}','Admin\CourseAssignTeacherController@ajaxCourseName')->name('admin.course_assign_teacher.ajaxCourseName');
    Route::post('/course_assign_teacher/add', 'Admin\CourseAssignTeacherController@add')->name('admin.course_assign_teacher.add');

});

//For admin view course statics
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/course_statics', 'Admin\ViewCourseStatics@index')->name('admin.course_statics.all');
    Route::get('/ajaxDepartmentCourseStatics/{id}','Admin\ViewCourseStatics@ajaxDepartmentCourseStatics')->name('admin.course_statics.ajaxDepartmentCourseStatics');

});


//For admin register students activities
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/register_students', 'Admin\RegisterStudentController@index')->name('admin.register_students.all');
    Route::post('/register_students/add', 'Admin\RegisterStudentController@add')->name('admin.register_students.add');
    Route::get('/register_students/view', 'Admin\RegisterStudentController@view')->name('admin.register_students.view');
    Route::post('/register_students/update', 'Admin\RegisterStudentController@update')->name('admin.register_students.update');
    Route::post('/register_students/delete', 'Admin\RegisterStudentController@delete')->name('admin.register_students.delete');

});

//For admin allocate class room
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/allocate_class_rooms', 'Admin\AllocateClassRoomController@index')->name('admin.allocate_class_rooms.all');
    Route::post('/allocate_class_rooms/add', 'Admin\AllocateClassRoomController@add')->name('admin.allocate_class_rooms.add');

});

//For admin view class schedule allocation room info
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::get('/class_schedule_allocation_rooms', 'Admin\ViewClassScheduleInfoController@index')->name('admin.class_schedule_allocation_rooms.all');
    Route::get('/ajaxDepartmentClassSchedule/{id}','Admin\ViewClassScheduleInfoController@ajaxDepartmentClassSchedule')->name('admin.class_schedule_allocation_rooms.ajaxDepartmentClassSchedule');

});