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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
Route::post('categories/sorter','CategoriesController@category');

//文章
Route::get('/article/{id}','CategoriesController@article');
//编辑页面
Route::get('/edit','ArticleController@edit')->middleware(['auth','verified']);
//图片处理
Route::post('/image','imageController@store');
Route::delete('/image','imageController@destroy');
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
Route::post('/ArticleController/comment_reply','ArticleController@comment_reply');
Route::post('/cover_upload', 'ArticleController@cover');

Route::post('/send', 'EmailController@send');

Route::post('/model/image','ModelController@BingImageSearch');
Route::post('/model/crop','ModelController@crop_pic');

Route::get('/format', function (){
    return view('format');
});

Route::any('/mode-1',function (){
    return view('article_mode1');
});

Route::get('/compose_plan/{article_id}/{plan_id}', 'ModelController@sendArticle')->middleware(['auth','verified']);

Route::get('/encrypt', 'ModelController@encrypt')->middleware(['auth','verified']);

Route::post('/image/class', 'imageController@classify')->middleware(['auth','verified']);

Route::post('/image/image_management', 'imageController@imageManagement')->middleware(['auth','verified']);

Route::get('/generateImage','ModelController@attnGan')->middleware(['auth','verified']);

Route::get('/image/saveAttn', 'imageController@saveAttn')->middleware(['auth','verified']);

Route::get('/test', function(){
    return view('test');
});

Route::get('/edit_1', function(){
    return view('edit_1');
});

Route::get('/ftp', 'HomeController@ftp');

Route::get('/image/raw/{filename}', function ($filename)
{

    $path = storage_path().'/app/image/raw/'.$filename;

    if (!File::exists($path)) {
        abort(404);
    }

//    $file = File::get($path);
//    $type = File::mimeType($path);

    return response()->file($path);
});

Route::post('/article/getId', 'ArticleController@getNextId');

Route::get('/testCompose', function(){
    return view('testCompose');
});

Route::get('/compose', 'TypeSettingController@main');


