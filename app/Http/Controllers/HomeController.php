<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct(){

    }
    public function index(){


        $articles=null;
        if(Cache::has('articlesToAll')){
            $articles=Cache::get('articlesToAll');

        }
        else{
            $articles=DB::table('articles')->where('share', 1)->orderBy('click_num')->limit(6)->get();
            //每半天更新一次推荐列表文章
            Cache::put('articlesToAll', $articles, 720);

        }
        //若是用户已经登录
        if(Auth::check()){
            $user_id=auth()->user()->id;
            //Apache的指令，换成Swoole需要更改

            for($i=1; $i<=6; $i++){
                if(Cache::has('user:'.$user_id.':cate:'.$i)){
                    $click_num=Cache::get('user:'.$user_id.':cate:'.$i);
                    $fp = fopen(resource_path().'/recommendation/data/data.csv', 'w');

                    fclose($fp);
                }
            }

            $output=shell_exec("cd ../resources/recommendation/recommend && python cf_run.py $user_id");

        }
        else{

        }
        return view('index1');
    }

    public function showArticle(){
        $csv = array_map('str_getcsv', file(resource_path().'/recommendation/data/data.csv'));

        $fp = fopen(resource_path().'/recommendation/data/data.csv', 'w');
        $list=array('UserID', 'KindID', 'Rating');
        fputcsv($fp, $list);

        for($user_id=1; $user_id<=1000; $user_id++){
            for($kind_id=1; $kind_id<=6; $kind_id++){
                $list = array($user_id, $kind_id, 0);
                fputcsv($fp, $list);
            }
        }
        fclose($fp);
    }

    public function chutu(){
        $str="river";
        //swoole
        //$output=shell_exec("cd ../resources/AttnGAN && ls .");
        //$output=passthru("source activate attngan && cd public/AttnGAN/code && python fine.py --str $str");
        //return $output;
        //laravel
        $output=$output = passthru("source activate attngan && cd ../resources/AttnGAN/code && python fine.py --str $str --name $str " );
        //$output = passthru("source activate attngan && cd /resources/AttnGAN/code && python fine.py --str $str --name 123");
        //$newName=time().'.png';
        //rename(public_path().'/AttnGAN/0_s_0_g2.png', public_path().'/images/a.png');
        return $output;
        //return response()->json(['output'=>$output]);
    }

    public function ftp(){
        $file = file_get_contents(storage_path().'/app/public/avatar/default_avatar.jpg');
        Storage::disk('ftp')->put('sample.jpg', $file);
        //echo $path;
    }
}

