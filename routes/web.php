<?php
Route::get('/', function () {
    if((isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')) || (isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('COORDINATOR')) || (isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('TEACHER'))){
        return view('pages.dashboard');
    }else{
        return view('pages.login');
    }
});

Route::get('/home', function () {    
    if((isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')) || (isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('COORDINATOR')) || (isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('TEACHER'))){
        return view('pages.dashboard');
    }else{
        return view('pages.login');    
    }
});

//Users
Route::get('/users', function () {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')){
        return view('pages.user.users');
    }else{
        return redirect('/');
    }    
});
Route::get('/new_user', function () {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')){
        return view('pages.user.new_user');
    }else{
        return redirect('/');
    }  
});
Route::get('/edit_user/{usercode}', function ($usercode) {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')){
        return view('pages.user.edit_user')->with(compact('usercode'));
    }else{
        return redirect('/');
    }     
});

//Type of Ocurrences
Route::get('/typesofocurrences', function () {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')){
        return view('pages.ocurrence_type.typesofocurrences');
    }else{
        return redirect('/');
    }      
});
Route::get('/new_type_ocurrence', function () {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')){
        return view('pages.ocurrence_type.new_type_ocurrence');
    }else{
        return redirect('/');
    }      
});
Route::get('/edit_type_ocurrence/{typeocurrencecode}', function ($typeocurrencecode) {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')){
        return view('pages.ocurrence_type.edit_type_ocurrence')->with(compact('typeocurrencecode'));
    }else{
        return redirect('/');
    }      
});

//Courses
Route::get('/courses', function () {
    if((isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')) || (isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('COORDINATOR'))){
        return view('pages.course.courses');
    }else{
        return redirect('/');
    }      
});
Route::get('/new_course', function () {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')){
        return view('pages.course.new_course');
    }else{
        return redirect('/');
    }   
});
Route::get('/edit_course/{coursecode}', function ($coursecode) {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')){
        return view('pages.course.edit_course')->with(compact('coursecode'));
    }else{
        return redirect('/');
    }      
});

//Couses Grades
Route::get('/courses/{coursecode}/grades', function ($coursecode) {
    if((isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')) || (isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('COORDINATOR'))){
        return view('pages.grade.grades')->with(compact('coursecode'));
    }else{
        return redirect('/');
    }  
});
Route::get('/courses/{coursecode}/new_grade', function ($coursecode) {
    if((isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')) || (isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('COORDINATOR'))){
        return view('pages.grade.new_grade')->with(compact('coursecode'));
    }else{
        return redirect('/');
    }      
});
Route::get('/courses/{coursecode}/edit_grade/{gradecode}', function ($coursecode,$gradecode) {
    if((isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')) || (isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('COORDINATOR'))){
        return view('pages.grade.edit_grade')->with(compact('coursecode','gradecode'));
    }else{
        return redirect('/');
    }  
});
//Courses Users
Route::get('/courses/{coursecode}/users', function ($coursecode) {
    if((isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')) || (isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('COORDINATOR'))){
        return view('pages.course_users.course_users')->with(compact('coursecode'));
    }else{
        return redirect('/');
    }     
});
Route::get('/courses/{coursecode}/add_users', function ($coursecode) {
    if((isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('ADMINISTRATOR')) || (isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('COORDINATOR'))){
        return view('pages.course_users.course_add_users')->with(compact('coursecode'));
    }else{
        return redirect('/');
    }     
});
//Ocurrences
Route::get('/ocurrences', function () {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('TEACHER')){
        return view('pages.ocurrence.ocurrences');
    }else{
        return redirect('/');
    }     
});
Route::get('/new_ocurrence', function () {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('TEACHER')){
        return view('pages.ocurrence.new_ocurrence');
    }else{
        return redirect('/');
    }     
});
Route::get('/edit_ocurrence/{ocurrencecode}', function ($ocurrencecode) {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('TEACHER')){
        return view('pages.ocurrence.edit_ocurrence')->with(compact('ocurrencecode'));
    }else{
        return redirect('/');
    }    
});
//Projects
Route::get('/projects', function () {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('TEACHER')){
        return view('pages.project.projects');
    }else{
        return redirect('/');
    }    
});
Route::get('/new_project', function () {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('TEACHER')){
        return view('pages.project.new_project');
    }else{
        return redirect('/');
    }     
});
//Ocurrences Coordinator
Route::get('/demandas', function () {
    if(isset($_COOKIE["isLogging"]) && $_COOKIE["isLogging"] == base64_encode('TEACHER')){
        return view('pages.ocurrence_coordinator.ocurrences');
    }else{
        return redirect('/');
    }     
});