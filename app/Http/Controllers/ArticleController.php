<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use DLArtist\DB\Article;

class ArticleController extends Controller
{
    //
    public function edit(){
        return view('edit');
    }
}
