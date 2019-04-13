<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('index');
    }

    public function showArticle($id){
        $storage=Redis::Connection();
        $view=$storage->incr('article:'.$id.':views');
        return "this is article ".$id." with ".$view." views";
    }

    public function chutu(){
        $str="关关雎鸠，在河之洲";
        //swoole
        $output=passthru("source activate attngan && cd public/AttnGAN/code && python fine.py --str $str");
        //laravel
        //$output = passthru("source activate attngan && cd AttnGAN/code && python fine.py --str $str");
        //$newName=time().'.png';
        //rename(public_path().'/AttnGAN/0_s_0_g2.png', public_path().'/images/a.png');
        return response()->json(['output'=>$output]);
    }
}

