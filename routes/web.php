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


Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'AdminController@dashboard');
    Route::get('section', 'SectionController@dashboard')->name('section');
    Route::get('/index', 'SectionController@index')->name('section');
    Route::resource('section', 'SectionController');
    Route::resource('subject', 'SubjectController');
    Route::resource('topic', 'TopicController');
    Route::resource('assignsubjects', 'AssignSubjectController');
    Route::resource('subtopic', 'SubTopicController');
    Route::resource('question', 'QuestionController');
    Route::resource('assignsubtopic', 'AssignSubTopicController');
    Route::resource('assigntopics', 'AssignTopicController');
    Route::get('crop-image', 'ImageController@index');
    Route::get('getsubjects', 'SubjectController@getSubjects')->name('getsubjects');
    Route::get('gettopics', 'TopicController@getTopics')->name('gettopics');
    Route::get('getsubtopics', 'SubTopicController@getSubTopics')->name('getsubtopics');
    Route::post('crop-image', ['as'=>'upload.image','uses'=>'ImageController@uploadImage']);

});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin', 'AdminController@index')->name('admin');

