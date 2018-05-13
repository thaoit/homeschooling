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
//URL::forceScheme('https');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lessons', 'LessonController@index');

Route::get('/lessons/create', 'LessonController@create');

Route::post('/lessons/store', 'LessonController@store');

Route::post('/lessons/update', 'LessonController@update');

Route::post('lessons/save-outlines', 'OutlineController@doStoreUpdateDelete');

Route::post('lessons/save-all-relating', 'GeneralController@saveAllRelatingLesson');

Route::get('lessons/filter-lessons-by-topics', 'LessonController@filterLessonsByTopics');

Route::get('lessons/filter-lessons-by-name', 'LessonController@filterLessonsByName');

Route::get('lessons/search', 'LessonController@searchNameInLesson');

Route::get('/lessons/love-lesson', 'LessonController@loveLesson');

Route::get('/lessons/unlove-lesson', 'LessonController@unloveLesson');

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

Route::get('/resources', 'LessonController@resources');

Route::get('/resources/search', 'LessonController@searchNameInResource');

Route::get('/groups', 'PartnerPostController@index');

Route::post('/groups/post', 'PartnerPostController@post');

Route::get('/groups/search', 'PartnerPostController@search');

Route::post('/groups/delete-post', 'PartnerPostController@delete');

Route::get('/profile/{username}', 'UserController@profile');

Route::post('/profile/add-child', 'UserController@storeChild');

Route::get('/topics/search', 'TopicController@search');

Route::post('/topics/save-topics', 'TopicController@doStoreUpdateDelete');

Route::post('/upload/media-references/new-upload', 'MediaController@storeUploadMediaReferences');

Route::post('/upload/media-references/new-url', 'MediaController@storeUrlMediaReferences');

Route::get('/upload/media-references-by-user', 'MediaController@getMediaReferencesByUser');

Route::get('/upload/media-references/view/{name}', 'MediaController@viewMediaReference');

Route::get('/media/get-default-types', 'MediaController@getDefaultTypes');
