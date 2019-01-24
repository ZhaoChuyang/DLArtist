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

Route::any('/', function () {
    return view('index');
});

Auth::routes();

Route::any('/home', 'HomeController@index')->name('home');

Route::any('/index', function(){
    return view('index');
});

Route::any('/categories', function(){
    return view('categories');
});

Route::any('/categories-1',function (){
    ////////////传参
   return view('categories-1');
});
Route::any('/categories-2',function (){
    ////////////传参
    return view('categories-2');
});
Route::any('/categories-3',function (){
    ////////////传参
    return view('categories-3');
});
Route::any('/categories-4',function (){
    ////////////传参
    return view('categories-4');
});
Route::any('/categories-5',function (){
    ////////////传参
    return view('categories-5');
});
Route::any('/article',function (){
    ////////////传参
    return view('article');
});

Route::get('/edit', function(){
    return view('edit');
});