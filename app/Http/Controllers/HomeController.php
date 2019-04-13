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
}

