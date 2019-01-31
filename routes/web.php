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
Route::any('/categories-1','CategoriesController@categories1');
Route::any('/categories-2','CategoriesController@categories2');
Route::any('/categories-3','CategoriesController@categories3');
Route::any('/categories-4','CategoriesController@categories4');
Route::any('/categories-5','CategoriesController@categories5');
Route::any('/categories-6','CategoriesController@categories6');
//文章
Route::any('/article','CategoriesController@article');
//编辑页面
Route::get('/edit','ArticleController@edit');
//图片处理
Route::resource('image', 'imageController');

//发表文章
Route::post('/article', 'ArticleController@store');

//账户信息
Route::get('/account', function(){
    return view('account');
})->middleware('auth');
