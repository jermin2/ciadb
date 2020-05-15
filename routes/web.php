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
Route::get('/home', 'UserController@home')->name('home');

Route::get('/people', 'PersonController@index')->name('people.index');
Route::post('/people', 'PersonController@store')->name('people.store');
Route::get('/people/create', 'PersonController@create')->name('people.create');
Route::get('/people/{person}', 'PersonController@show')->name('people.show');
Route::get('/people/{person}/edit', 'PersonController@edit')->name('people.edit');
Route::put('/people/{person}', 'PersonController@update')->name('people.update');


Route::get('/people/tags/{tag}', 'PersonTagController@show')->name('tag.show');

Route::get('/events/people', 'EventPersonController@index')->name('event.person.index');
Route::get('/events/people/{person}', 'EventPersonController@show')->name('event.person.show');


Route::get('/events', 'EventController@index')->name('events.index');
Route::get('/events/create', 'EventController@create')->name('events.create');
Route::post('/events', 'EventController@store')->name('events.store');
Route::get('/events/{event}', 'EventController@show')->name('events.show');
Route::get('/events/{event}/edit', 'EventController@edit')->name('events.edit');
Route::put('/events/{event}', 'EventController@update')->name('events.update');

Route::delete('/events/{event}', 'EventController@delete')->name('events.delete');

Route::get('/events/tags/{tag}', 'EventTagController@show')->name('event-tag.show');


Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('/users/{user}', 'UserController@update')->name('users.update')->middleware('can:edit_events');;
Route::delete('/users/{user}', 'UserController@delete')->name('users.delete');

Route::get('/tags', 'UsertagController@index')->name('usertags.index');
Route::post('/tags', 'UsertagController@store')->name('usertags.store');

