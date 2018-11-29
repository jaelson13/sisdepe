<?php

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/users', function () {
    return view('pages.user.users');
});
Route::get('/new_user', function () {
    return view('pages.user.new_user');
});
Route::get('/edit_user/{usercode}', function ($usercode) {
    return view('pages.user.edit_user')->with(compact('usercode'));
});

//Type of Ocurrences
Route::get('/typesofocurrences', function () {
    return view('pages.ocurrence.typesofocurrences');
});
Route::get('/new_type_ocurrence', function () {
    return view('pages.ocurrence.new_type_ocurrence');
});
Route::get('/edit_type_ocurrence/{typeocurrencecode}', function ($typeocurrencecode) {
    return view('pages.ocurrence.edit_type_ocurrence')->with(compact('typeocurrencecode'));
});

//Courses
Route::get('/courses', function () {
    return view('pages.course.courses');
});
Route::get('/new_course', function () {
    return view('pages.course.new_course');
});
Route::get('/edit_course/{coursecode}', function ($coursecode) {
    return view('pages.course.edit_course')->with(compact('coursecode'));
});

//Couses Grades
Route::get('/courses/{coursecode}/grades', function ($coursecode) {
    return view('pages.grade.grades')->with(compact('coursecode'));
});
Route::get('/courses/{coursecode}/new_grade', function ($coursecode) {
    return view('pages.grade.new_grade')->with(compact('coursecode'));
});
Route::get('/courses/{coursecode}/edit_grade/{gradecode}', function ($coursecode,$gradecode) {
    return view('pages.grade.edit_grade')->with(compact('coursecode','gradecode'));
});
//Courses Users
Route::get('/courses/{coursecode}/users', function ($coursecode) {
    return view('pages.course_users.course_users')->with(compact('coursecode'));
});
Route::get('/courses/{coursecode}/add_users', function ($coursecode) {
    return view('pages.course_users.course_add_users')->with(compact('coursecode'));
});