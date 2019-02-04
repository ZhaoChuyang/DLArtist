<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class accounts extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeAvatar(Request $request){

    }

}
