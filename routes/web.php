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

Route::get('/lessons', 'LessonController@index');

Route::get('/lessons/create', 'LessonController@create');

Route::post('/lessons/store', 'LessonController@store');

Route::post('/lessons/update', 'LessonController@update');

Route::post('lessons/save-outlines', 'OutlineController@doStoreUpdateDelete');

Route::post('lessons/save-all-relating', 'GeneralController@saveAllRelatingLesson');

Route::get('/lessons/view/{id}', 'LessonController@view');

Route::get('/lessons/edit/{id}', 'LessonController@edit');

Route::get('/lessons/delete/{id}', 'LessonController@delete');

Route::get('/tests', function(){
    return view('test.index');
});

Route::get('/tests/create', function(){
    return view('test.create');
});

Route::get('/tests/view', function(){
    return view('test.view');
});

Route::get('/resources', function(){
    return view('community.resource');
});

Route::get('/groups', function(){
    return view('community.group');
});

Route::get('/profile', function(){
    return view('user.profile');
});

Route::get('/topics/search', 'TopicController@search');

Route::post('/topics/save-topics', 'TopicController@doStoreUpdateDelete');

Route::post('/upload/media-references/new-upload', 'MediaController@storeUploadMediaReferences');

Route::post('/upload/media-references/new-url', 'MediaController@storeUrlMediaReferences');

Route::get('/upload/media-references-by-user', 'MediaController@getMediaReferencesByUser');

Route::get('/upload/media-references/view/{name}', 'MediaController@viewMediaReference');
