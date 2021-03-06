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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->prefix('/lessons')->group(function(){

  Route::get('/', 'LessonController@index');

  Route::get('/create', 'LessonController@create');

  Route::post('/store', 'LessonController@store');

  Route::post('/update', 'LessonController@update');

  Route::post('/save-outlines', 'OutlineController@doStoreUpdateDelete');

  Route::post('/save-all-relating', 'GeneralController@saveAllRelatingLesson');

  Route::get('/edit/{permalink}', 'LessonController@edit');

  Route::get('/delete/{id}', 'LessonController@delete');

  Route::get('/load-more-lessons', 'LessonController@loadMoreLessons');
});

Route::prefix('/lessons')->group(function(){

  Route::get('/view/{permalink}', 'LessonController@view');

  Route::get('/filter-lessons-by-topics', 'LessonController@filterLessonsByTopics');

  Route::get('/filter-lessons-by-name', 'LessonController@filterLessonsByName');

  Route::get('/search-in-lesson', 'LessonController@searchNameInLesson');

  Route::get('/love-lesson', 'LessonController@loveLesson');

  Route::get('/unlove-lesson', 'LessonController@unloveLesson');
});

Route::middleware('auth')->prefix('/tests')->group(function(){

  Route::get('/', function(){
      return view('test.index');
  });

  Route::get('/create', function(){
      return view('test.create');
  });

  Route::get('/view', function(){
      return view('test.view');
  });
});

Route::prefix('/resources')->group(function(){

  Route::get('/', 'LessonController@resources');

  Route::get('/search-in-resource', 'LessonController@searchNameInResource');
});

Route::middleware('auth')->prefix('/groups')->group(function(){

  Route::get('/', 'PartnerPostController@index');

  Route::post('/post', 'PartnerPostController@post');

  Route::get('/search', 'PartnerPostController@search');

  Route::post('/delete-post', 'PartnerPostController@delete');

  Route::get('/get-provinces-by-country', 'ProvinceController@getAllByCountry');

  Route::get('/load-more-not-own-posts', 'PartnerPostController@loadMoreNotOwnPosts');

  Route::get('/load-more-own-posts', 'PartnerPostController@loadMoreOwnPosts');
});

Route::middleware('auth')->prefix('/profile')->group(function(){

  Route::get('/{username}', 'UserController@profile');

  Route::post('/add-child', 'UserController@storeChild');

  Route::post('/delete', 'UserController@delete');

  Route::post('/change-account', 'UserController@changeAccount');

  Route::post('/update-general-profile', 'UserController@updateGeneralProfile');

});

Route::prefix('/topics')->group(function(){

  Route::get('/search', 'TopicController@search');

  Route::post('/save-topics', 'TopicController@doStoreUpdateDelete');
});

Route::middleware('auth')->prefix('/upload')->group(function(){

  Route::post('/media-references/new-upload', 'MediaController@storeUploadMediaReferences');

  Route::post('/media-references/new-url', 'MediaController@storeUrlMediaReferences');

  Route::get('/media-references-by-user', 'MediaController@getMediaReferencesByUser');

});

Route::get('/upload/media-references/view/{name}', 'MediaController@viewMediaReference');

Route::get('/media/get-default-types', 'MediaController@getDefaultTypes');
