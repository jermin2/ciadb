<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', 'UserController@home')->name('home');
Route::get('/dashboard', 'UserController@home')->name('dashboard');

Route::get('/people', 'PersonController@index')->name('people.index');
Route::post('/people', 'PersonController@store')->name('people.store');
Route::get('/people/create', 'PersonController@create')->name('people.create');
Route::get('/people/{person}', 'PersonController@show')->name('people.show');
Route::get('/people/{person}/edit', 'PersonController@edit')->name('people.edit');
Route::put('/people/{person}', 'PersonController@update')->name('people.update');
Route::get('people/{person}/delete', 'PersonController@delete')->name('people.delete');

Route::get('/people/tags/{tag}', 'PersonTagController@showByTag')->name('people-tag.show');
Route::get('/people/usertags/{usertag}', 'PersonTagController@showByUserTag')->name('people-usertag.show');

Route::get('/pivot', 'EventPersonController@index')->name('event.person.index');
Route::get('/events/people/{person}', 'EventPersonController@show')->name('event.person.show');


Route::get('/events', 'EventController@index')->name('events.index');
Route::get('/events/create', 'EventController@create')->name('events.create');
Route::post('/events', 'EventController@store')->name('events.store');
Route::get('/events/{event}', 'EventController@show')->name('events.show');
Route::get('/events/{event}/edit', 'EventController@edit')->name('events.edit');
Route::put('/events/{event}', 'EventController@update')->name('events.update');

Route::get('/events/{event}/delete', 'EventController@delete')->name('events.delete');

Route::get('/events/tags/{tag}', 'EventTagController@showByTag')->name('event-tag.show');
Route::get('/events/usertags/{usertag}', 'EventTagController@showByUserTag')->name('event-usertag.show');

Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('/users/{user}', 'UserController@update')->name('users.update')->middleware('can:edit_events');;
Route::delete('/users/{user}', 'UserController@delete')->name('users.delete');

Route::get('/tags/{usertag}/delete', 'UsertagController@delete')->name('usertags.delete');
Route::get('/tags', 'UsertagController@index')->name('usertags.index');
Route::post('/tags', 'UsertagController@store')->name('usertags.store');

Route::get('ajaxRequest', 'AjaxController@ajaxRequest');
Route::post('ajaxRequest', 'EventPersonController@ajaxRequestPost')->name('ajaxRequest.post');


Route::get('people/{person}/goals/{goal}', 'PersonGoalController@delete')->name('goals.delete');
Route::put('people/{person}/goals/{goal}/update', 'PersonGoalController@update')->name('goals.update');
Route::get('people/{person}/goals/{goal}/edit', 'PersonGoalController@edit')->name('goals.edit');
Route::post('people/{person}/goals', 'PersonGoalController@store')->name('goals.storea');

Route::post('goals', 'PersonGoalController@store')->name('goals.store');