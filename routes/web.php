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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


Route::any('/', 'HomeController@index');

Auth::routes(['verify' => true]);

Route::any('/home', 'HomeController@index')->name('home')->middleware(['auth']);

Route::get('/index', 'HomeController@index')->middleware(['auth']);
//分类
Route::any('/categories', function(){
    return view('categories');
})->middleware(['auth']);;
//具体分类
Route::post('categories/sorter','CategoriesController@category')->middleware(['auth']);

//文章
Route::get('/article/{id}','CategoriesController@article')->middleware(['auth']);
//编辑页面
Route::get('/edit','ArticleController@edit')->middleware(['auth']);
//图片处理
Route::post('/image','imageController@store');
Route::delete('/image','imageController@destroy');
//发表文章
Route::post('/article', 'ArticleController@store');

//账户信息
Route::get('/account', function(){
    return view('account');
})->middleware(['auth']);

Route::get('/account/{info}',function($info){
    return View::make('ajax/account')->with('info', $info)->with('user_id', Auth::user()->id)->render();
})->middleware(['auth']);

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

Route::get('/compose_plan/{article_id}/{plan_id}', 'ModelController@sendArticle')->middleware(['auth']);

Route::get('/encrypt', 'ModelController@encrypt')->middleware(['auth']);

Route::post('/image/class', 'imageController@classify')->middleware(['auth']);

Route::post('/image/image_management', 'imageController@imageManagement')->middleware(['auth']);

Route::get('/generateImage','ModelController@attnGan')->middleware(['auth']);

Route::get('/image/saveAttn', 'imageController@saveAttn')->middleware(['auth']);

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

Route::get('/image/cover/{filename}', function ($filename)
{

    $path = storage_path().'/app/image/cover/'.$filename;

    if (!File::exists($path)) {
        abort(404);
    }

//    $file = File::get($path);
//    $type = File::mimeType($path);

    return response()->file($path);
});

Route::get('/image/gen/{filename}', function ($filename)
{

    $path = resource_path().'/AttnGAN/'.$filename;

    if (!File::exists($path)) {
        abort(404);
    }

    return response()->file($path);
});

Route::post('/article/getId', 'ArticleController@getNextId');

Route::get('/testCompose', function(){
    return view('testCompose');
});

Route::post('/compose', 'TypeSettingController@main');

Route::get('/tfjs_quan_1/{filename}', function($filename){

   $path = resource_path().'/tfjsClassify/'.$filename;

    if (!File::exists($path)) {
        abort(404);
    }

    return response()->file($path);
});

Route::get('/clean', 'imageController@cleanImages');

Route::get('/image/classify', 'imageController@imageClassify');

Route::post('/inDesign', 'typeSettingController@connectIndesign');

Route::post('/genSummary', 'ModelController@genSummary');

Route::post('/recomImage', 'imageController@recommendImage');

Route::get('/calcColor', 'ModelController@calcColor');

Route::get('/edit_2', function(){
    return view('edit_2');
});
Route::get('/fanyi', 'typeSettingController@testfanyi');

Route::get('/pdf/{id}', function($id){

    if(Storage::disk('local')->exists("pdf/$id.pdf")){
        return response()->file(storage_path().'/app/pdf/'.$id.'.pdf');
    }else{
        $file_ftp = Storage::disk('ftp')->get("pdf/$id.pdf");
        $file_local = Storage::disk('local')->put("pdf/$id.pdf", $file_ftp);
        return response()->file(storage_path().'/app/pdf/'.$id.'.pdf');
    }



});

Route::post('/compose_pro', 'TypeSettingController@compose_pro');



