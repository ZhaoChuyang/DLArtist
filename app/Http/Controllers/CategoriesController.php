<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use DLArtist\DB\Article;
use Illuminate\Support\Facades\Input;
use DB;
class CategoriesController extends Controller
{
    //
    public function categories1(){
//文娱
        $category = '文娱点评';
        $article = new Article();
        $data = $article->where('category',$category)->get();
        return view('categories-1',compact('data'));
    }
    public function categories2(){
//军事
        $category = '军事分析';
        $article = new Article();
        $data = $article->where('category',$category)->get();
        return view('categories-2',compact('data'));
    }
    public function categories3(){
//时事
        $category = '时事评论';
        $article = new Article();
        $data = $article->where('category',$category)->get();
        return view('categories-3',compact('data'));
    }
    public function categories4(){
//技术
        $category = '技术博客';
        $article = new Article();
        $data = $article->where('category',$category)->get();
        return view('categories-4',compact('data'));
    }
    public function categories5(){
//教育
        $category = '教育文化';
        $article = new Article();
        $data = $article->where('category',$category)->get();
        return view('categories-5',compact('data'));
    }

    public function categories6(){
//全部
        $category = '*';
        $article = new Article();
        $data = $article->all();
        return view('categories-6',compact('data'));
    }

    public function article(){
//具体文章
        $article=new Article();
        $id=$_GET['id'];
        $title=$article->where('id',$id)->select('title')->get()->toArray();
        $content=$article->where('id',$id)->select('content')->get()->toArray();
        $time=$article->where('id',$id)->select('updated_at')->get();

        return view('article',compact('title','content','time'));
    }
}
