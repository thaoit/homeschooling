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

Route::get('/lessons', function(){
    return view('lesson.index');
});

Route::get('/lessons/create', function(){
    return view('lesson.create');
});

Route::get('/tests', function(){
    return view('test.index');
});

Route::get('/tests/create', function(){
    return view('test.create');
});
