<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('index');
    }
    public function categories1(){
//文娱

        return view('categories-1');
    }
    public function categories2(){
//军事

        return view('categories-2');
    }
    public function categories3(){
//时事

        return view('categories-3');
    }
    public function categories4(){
//技术

        return view('categories-4');
    }
    public function categories5(){
//教育

        return view('categories-5');
    }

    public function article(){
//具体文章

        return view('article');
    }
}
