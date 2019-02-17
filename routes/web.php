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

Auth::routes(['verify' => true]);

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
Route::post('/image','imageController@store');
Route::delete('image','imageController@destroy');
//发表文章
Route::post('/article', 'ArticleController@store');

//账户信息
Route::get('/account', function(){
    return view('account');
})->middleware(['auth','verified']);

Route::get('/account/{info}',function($info){
    return View::make('ajax/account')->with('info', $info)->with('user_id', Auth::user()->id)->render();
})->middleware(['auth','verified']);

Route::post('/accounts/avatar','accounts@storeAvatar');
Route::post('/accounts/save','accounts@saveinfo');
Route::post('accounts/adminPwd','accounts@adminPwd');
Route::post('accounts/adminMail','accounts@adminMail');

Route::get('/image/getImageList', 'imageController@list');

Route::post('/ArticleController/comment','ArticleController@comment');

Route::post('/cover_upload', 'ArticleController@cover');

Route::post('/send', 'EmailController@send');

Route::get('/test', function (){
    return view('test');
});
