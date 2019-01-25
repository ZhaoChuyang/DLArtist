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
//分类
Route::any('/categories', function(){
    return view('categories');
});
//具体分类
Route::any('/categories-1','HomeController@categories1');
Route::any('/categories-2','HomeController@categories2');
Route::any('/categories-3','HomeController@categories3');
Route::any('/categories-4','HomeController@categories4');
Route::any('/categories-5','HomeController@categories5');
//文章
Route::any('/article','HomeController@article');
//编辑页面
Route::get('/edit', function(){
    return view('edit');
});