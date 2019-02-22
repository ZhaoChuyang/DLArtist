<?php

namespace DLArtist\Http\Controllers;

use DLArtist\DB\Comment;
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
        $current=(int)$_GET['page'];
        $perpage_num=6;
        $article = new Article();
        $user = new User();
        if(auth()->user()){
            $user_id=auth()->user()->id;
        }
        else{
            $user_id=-1;
        }
        $num=$article->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->get()->count('id');
        $last=ceil($num/$perpage_num);
        if(!$last)$last=1;
        $down=$up=0;
        if ($current>$last||$current==$last){
            if($current>$last)
                $down=2;
            else
                $down=1;
            $current=$last;
        }
        if($current<1||$current==1){
            if($current<1)
                $up=2;
            else
                $up=1;
            $current=1;
        }
        $data = $article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
            $query->where('share','1')->orwhere('user_id',$user_id);
        })->orderby('click_num','desc')->paginate($perpage_num);
        $writer = $user->get();
        return view('categories-1',compact('data','writer','current','last','up','down'));

    }
    public function categories2(){
//军事
        $category = '军事分析';
        $current=(int)$_GET['page'];
        $perpage_num=6;
        $article = new Article();
        $user = new User();
        if(auth()->user()){
            $user_id=auth()->user()->id;
        }
        else{
            $user_id=-1;
        }
        $num=$article->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->get()->count('id');
        $last=ceil($num/$perpage_num);
        if(!$last)$last=1;
        $down=$up=0;
        if ($current>$last||$current==$last){
            if($current>$last)
                $down=2;
            else
                $down=1;
            $current=$last;
        }
        if($current<1||$current==1){
            if($current<1)
                $up=2;
            else
                $up=1;
            $current=1;
        }
        $data = $article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
            $query->where('share','1')->orwhere('user_id',$user_id);
        })->orderby('click_num','desc')->paginate($perpage_num);
        $writer = $user->get();
        return view('categories-2',compact('data','writer','current','last','up','down'));

    }
    public function categories3(){
//时事
        $category = '时事评论';
        $current=(int)$_GET['page'];
        $perpage_num=6;
        $article = new Article();
        $user = new User();
        if(auth()->user()){
            $user_id=auth()->user()->id;
        }
        else{
            $user_id=-1;
        }
        $num=$article->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->get()->count('id');
        $last=ceil($num/$perpage_num);
        if(!$last)$last=1;
        $down=$up=0;
        if ($current>$last||$current==$last){
            if($current>$last)
                $down=2;
            else
                $down=1;
            $current=$last;
        }
        if($current<1||$current==1){
            if($current<1)
                $up=2;
            else
                $up=1;
            $current=1;
        }
        $data = $article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
            $query->where('share','1')->orwhere('user_id',$user_id);
        })->orderby('click_num','desc')->paginate($perpage_num);
        $writer = $user->get();
        return view('categories-3',compact('data','writer','current','last','up','down'));

    }
    public function categories4(){
//技术
        $category = '技术博客';
        $current=(int)$_GET['page'];
        $perpage_num=6;
        $article = new Article();
        $user = new User();
        if(auth()->user()){
            $user_id=auth()->user()->id;
        }
        else{
            $user_id=-1;
        }
        $num=$article->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->get()->count('id');
        $last=ceil($num/$perpage_num);
        if(!$last)$last=1;
        $down=$up=0;
        if ($current>$last||$current==$last){
            if($current>$last)
                $down=2;
            else
                $down=1;
            $current=$last;
        }
        if($current<1||$current==1){
            if($current<1)
                $up=2;
            else
                $up=1;
            $current=1;
        }
        $data = $article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
            $query->where('share','1')->orwhere('user_id',$user_id);
        })->orderby('click_num','desc')->paginate($perpage_num);
        $writer = $user->get();
        return view('categories-4',compact('data','writer','current','last','up','down'));

    }
    public function categories5(){
//教育
        $category = '教育文化';
        $current=(int)$_GET['page'];
        $perpage_num=6;
        $article = new Article();
        $user = new User();
        if(auth()->user()){
            $user_id=auth()->user()->id;
        }
        else{
            $user_id=-1;
        }
        $num=$article->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->get()->count('id');
        $last=ceil($num/$perpage_num);
        if(!$last)$last=1;
        $down=$up=0;
        if ($current>$last||$current==$last){
            if($current>$last)
                $down=2;
            else
                $down=1;
            $current=$last;
        }
        if($current<1||$current==1){
            if($current<1)
                $up=2;
            else
                $up=1;
            $current=1;
        }
        $data = $article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
            $query->where('share','1')->orwhere('user_id',$user_id);
        })->orderby('click_num','desc')->paginate($perpage_num);
        $writer = $user->get();
        return view('categories-5',compact('data','writer','current','last','up','down'));

    }

    public function categories6(){
//全部
        $category = '*';
        $current=$_GET['page'];
        $perpage_num=6;
        $article = new Article();
        $user = new User();
        if(auth()->user()){
            $user_id=auth()->user()->id;
        }
        else{
            $user_id=-1;
        }
        $num=$article->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->get()->count('id');
        $last=ceil($num/$perpage_num);
        if(!$last)$last=1;
        $down=$up=0;
        if ($current>$last||$current==$last){
            if($current>$last)
                $down=2;
            else
                $down=1;
            $current=$last;
        }
        if($current<1||$current==1){
            if($current<1)
                $up=2;
            else
                $up=1;
            $current=1;
        }
        $data = $article->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->orderby('click_num','desc')->paginate($perpage_num);
        $writer = $user->get();
        return view('categories-6',compact('data','writer','current','last','up','down'));
    }

    public function article(){
//具体文章
        $article=new Article();
        $comment=new Comment();
        $id=$_GET['id'];
        $article->where('id',$id)->increment('click_num');
        $title=$article->where('id',$id)->select('title')->get();
        if(auth()->user())
            $user_id=auth()->user()->id;
        else
            $user_id=-1;
        $user_name=DB::table('users')->join('articles','users.id','=','user_id')->where('articles.id',$id)->select('name')->first();
        $content=$article->where('id',$id)->select('content')->get();
        $time=$article->where('id',$id)->select('update')->get();
        $comment_num=$comment->where('article_id',$id)->where('valid',1)->get()->count();
        $comments=DB::table('comments')->join('users','users.id','=','user_id')->where('article_id',$id)->where('valid',1)->select('comments.id','name','update','content','avatar_url')->limit(5)->offset(0)->orderby('comments.id','desc')->get();
        $reply=DB::table('reply')->join('users','users.id','=','user_id')->where('article_id',$id)->where('valid',1)->select('pid','reply.id','name','update','content','avatar_url','reply_name')->orderby('pid','desc')->get();
        return view('article',compact('title','content','time','user_name','comment_num','comments','id','user_id','reply'));
    }
}
