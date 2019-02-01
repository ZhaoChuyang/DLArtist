<?php

namespace DLArtist\Http\Controllers;

use DLArtist\User;
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
        $user = new User();
        $data = $article->where('category',$category)->get();
        $writer = $user->get();
        return view('categories-1',compact('data','writer'));
    }
    public function categories2(){
//军事
        $category = '军事分析';
        $article = new Article();
        $user = new User();
        $data = $article->where('category',$category)->get();
        $writer = $user->get();
        return view('categories-2',compact('data','writer'));
    }
    public function categories3(){
//时事
        $category = '时事评论';
        $article = new Article();
        $user = new User();
        $data = $article->where('category',$category)->get();
        $writer = $user->get();
        return view('categories-3',compact('data','writer'));
    }
    public function categories4(){
//技术
        $category = '技术博客';
        $article = new Article();
        $user = new User();
        $data = $article->where('category',$category)->get();
        $writer = $user->get();
        return view('categories-4',compact('data','writer'));
    }
    public function categories5(){
//教育
        $category = '教育文化';
        $article = new Article();
        $user = new User();
        $data = $article->where('category',$category)->get();
        $writer = $user->get();
        return view('categories-5',compact('data','writer'));
    }

    public function categories6(){
//全部
        $category = '*';
        $article = new Article();
        $user = new User();
        $data = $article->all();
        $writer = $user->get();
        return view('categories-6',compact('data','writer'));
    }

    public function article(){
//具体文章
        $article=new Article();
        $id=$_GET['id'];
        $title=$article->where('id',$id)->select('title')->get();
        $user_id=$article->where('id',$id)->select("user_id")->get()->toArray();
        foreach ($user_id as $key => $val){
            $t=$val;
        }
        $user_name=DB::table('users')->join('articles','users.id','=','user_id')->where('users.id',$t)->select('name')->first();
        $content=$article->where('id',$id)->select('content')->get();
        $time=$article->where('id',$id)->select('update')->get();
        return view('article',compact('title','content','time','user_name'));
    }
}
