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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/people', 'PersonController@index')->name('people.index');
Route::post('/people/create', 'PersonController@store')->name('people.store');
Route::get('/people/create', 'PersonController@create')->name('people.create');
Route::get('/people/{person}', 'PersonController@show')->name('people.show');
Route::get('/people/{person}/edit', 'PersonController@edit')->name('people.edit');
Route::put('/people/{person}', 'PersonController@update')->name('people.update');


Route::get('/tags/{tag}', 'TagController@show')->name('tag.show');

Route::get('/events', 'EventController@index')->name('events.index');