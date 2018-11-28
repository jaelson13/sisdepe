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