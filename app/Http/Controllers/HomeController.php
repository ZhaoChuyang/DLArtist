<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('index');
    }

    public function showArticle($id){
        //$redis=Redis::connection();
        //$redis->set("a", "123");
        Cache::put('redis',5, 10);
        return Cache::get('redis', 4);
        return $redis->get("a");
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

