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
        $num=$article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
            $query->where('share','1')->orwhere('user_id',$user_id);
        })->get()->count('id');
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

        $user_num=$user->get()->count('id');
        $article_num=$article->where('category',$category)->where('valid',1)->get()->count('id');
        date_default_timezone_set("PRC");
        $time=date('Y-m-d',time());
        $new_article=$article->where('category',$category)->where('valid',1)->where('update','like',$time.'%')->get()->count('id');
        return view('categories-1',compact('data','writer','current','last','up','down','user_num','article_num','new_article'));

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
        $num=$article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
            $query->where('share','1')->orwhere('user_id',$user_id);
        })->get()->count('id');        $last=ceil($num/$perpage_num);
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

        $user_num=$user->get()->count('id');
        $article_num=$article->where('category',$category)->where('valid',1)->get()->count('id');
        date_default_timezone_set("PRC");
        $time=date('Y-m-d',time());
        $new_article=$article->where('category',$category)->where('valid',1)->where('update','like',$time.'%')->get()->count('id');
        return view('categories-2',compact('data','writer','current','last','up','down','user_num','article_num','new_article'));

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
        $num=$article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
            $query->where('share','1')->orwhere('user_id',$user_id);
        })->get()->count('id');        $last=ceil($num/$perpage_num);
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

        $user_num=$user->get()->count('id');
        $article_num=$article->where('category',$category)->where('valid',1)->get()->count('id');
        date_default_timezone_set("PRC");
        $time=date('Y-m-d',time());
        $new_article=$article->where('category',$category)->where('valid',1)->where('update','like',$time.'%')->get()->count('id');
        return view('categories-3',compact('data','writer','current','last','up','down','user_num','article_num','new_article'));

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
        $num=$article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
            $query->where('share','1')->orwhere('user_id',$user_id);
        })->get()->count('id');        $last=ceil($num/$perpage_num);
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

        $user_num=$user->get()->count('id');
        $article_num=$article->where('category',$category)->where('valid',1)->get()->count('id');
        date_default_timezone_set("PRC");
        $time=date('Y-m-d',time());
        $new_article=$article->where('category',$category)->where('valid',1)->where('update','like',$time.'%')->get()->count('id');
        return view('categories-4',compact('data','writer','current','last','up','down','user_num','article_num','new_article'));

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
        $num=$article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
            $query->where('share','1')->orwhere('user_id',$user_id);})->get()->count('id');
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

        $user_num=$user->get()->count('id');
        $article_num=$article->where('category',$category)->where('valid',1)->get()->count('id');
        date_default_timezone_set("PRC");
        $time=date('Y-m-d',time());
        $new_article=$article->where('category',$category)->where('valid',1)->where('update','like',$time.'%')->get()->count('id');
        return view('categories-5',compact('data','writer','current','last','up','down','user_num','article_num','new_article'));

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

        $user_num=$user->get()->count('id');
        $article_num=$article->get()->count('id');
        date_default_timezone_set("PRC");
        $time=date('Y-m-d',time());
        $new_article=$article->where('update','like',$time.'%')->get()->count('id');
        return view('categories-6',compact('data','writer','current','last','up','down','user_num','article_num','new_article'));
    }

    public function category(Request $request){
        $article = new Article();
        $user = new User();
        if(auth()->user()){
            $user_id=auth()->user()->id;
        }
        else{
            $user_id=-1;
        }
        $perpage_num=6;
        $next_page=true;
        $pre_page=true;
        $category_val=$request->input('category_val');
        $sorter_val=$request->input('sorter_val');
        $page=$request->input('page');
        $asc=$request->input('asc')[$sorter_val-1];
        $user_num=$user->get()->count('id');
        $article_num=$article->get()->count('id');
        date_default_timezone_set("PRC");
        $time=date('Y-m-d',time());
        $new_article=$article->where('update','like',$time.'%')->get()->count('id');
        if($category_val==6){
            $num=$article->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->get()->count('id');
            $last=ceil($num/$perpage_num);
            if($page>=$last){
                $next_page=false;
            }
            if($page==1){
                $pre_page=false;
            }
            if($sorter_val==1){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else if($sorter_val==2){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else{
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('share','1')->where('valid',1)->orwhere('user_id',$user_id)->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);            }
        }
        else if($category_val==5){
            $category = '教育文化';
            $num=$article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                $query->where('share','1')->orwhere('user_id',$user_id);})->get()->count('id');
            $last=ceil($num/$perpage_num);
            if($page>=$last){
                $next_page=false;
            }
            if($page==1){
                $pre_page=false;
            }
            if($sorter_val==1){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else if($sorter_val==2){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else{
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }
        }
        else if($category_val==4){
            $category = '技术博客';
            $num=$article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                $query->where('share','1')->orwhere('user_id',$user_id);})->get()->count('id');
            $last=ceil($num/$perpage_num);
            if($page>=$last){
                $next_page=false;
            }
            if($page==1){
                $pre_page=false;
            }
            if($sorter_val==1){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else if($sorter_val==2){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else{
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }
        }
        else if($category_val==3){
            $category = '时事评论';
            $num=$article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                $query->where('share','1')->orwhere('user_id',$user_id);})->get()->count('id');
            $last=ceil($num/$perpage_num);
            if($page>=$last){
                $next_page=false;
            }
            if($page==1){
                $pre_page=false;
            }
            if($sorter_val==1){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else if($sorter_val==2){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else{
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }
        }
        else if($category_val==2){
            $category = '军事分析';
            $num=$article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                $query->where('share','1')->orwhere('user_id',$user_id);})->get()->count('id');
            $last=ceil($num/$perpage_num);
            if($page>=$last){
                $next_page=false;
            }
            if($page==1){
                $pre_page=false;
            }
            if($sorter_val==1){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else if($sorter_val==2){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else{
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }
        }
        else{
            $category = '文娱点评';
            $num=$article->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                $query->where('share','1')->orwhere('user_id',$user_id);})->get()->count('id');
            $last=ceil($num/$perpage_num);
            if($page>=$last){
                $next_page=false;
            }
            if($page==1){
                $pre_page=false;
            }
            if($sorter_val==1){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('title','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else if($sorter_val==2){
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('update','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }else{
                if(!$asc)
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','desc')->get();
                else
                    $data=DB::table('users')->join('articles','users.id','=','user_id')->where('category',$category)->where('valid',1)->where(function ($query)use($user_id){
                        $query->where('share','1')->orwhere('user_id',$user_id);
                    })->offset(($page-1)*$perpage_num)->limit($perpage_num)->orderby('click_num','asc')->get();
                return response()->json(['pre_page'=>$pre_page, 'next_page'=>$next_page, 'data'=>$data,'user_num'=>$user_num,'article_num'=>$article_num,'new_article'=>$new_article]);
            }
        }
    }


    public function article($id){
//具体文章
        $article=new Article();
        $comment=new Comment();

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
