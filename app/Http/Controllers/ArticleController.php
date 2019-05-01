<?php

namespace DLArtist\Http\Controllers;

use DLArtist\DB\Comment;
use DLArtist\DB\reply;
use Illuminate\Http\Request;
use DLArtist\DB\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use DLArtist\Jobs\IOTasks;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function getNextId(){

        //最大article_id
        $max_id=0;

        //当cache中没有当前可用的最大文章id的缓存时
        if(!Cache::has('max_article_id')){
            $max_id=DB::table('articles')->max('id')+1;
            Cache::put('max_article_id', $max_id, 1440);
        }

        $max_id=Cache::get('max_article_id');
        Cache::increment('max_article_id');

        return $max_id;
    }

    public function edit()
    {
        return view('edit');
    }

    public function compose($id){

    }

    public function append(){

    }

    public function store(Request $request)
    {
        $validator=Validator:: make($request->all(),[
            'article_id' => 'required',
            'title' => 'required',
            'category' => 'required|not_in:0',
            'shareStatus'=>'required',
        ]);

        if($validator->fails()){
            return $validator->errors()->add('status', 0);
        }

        DB::beginTransaction();

        try {

            $title=$request->input('title');
            $user_id=auth()->user()->id;
            $cover_url=$request->input('cover_url');
            $article_id=$request->input('article_id');

            //设置时区
            date_default_timezone_set("PRC");
            $update=date('Y-m-d H:i:s',time());

            $content=$request->input('content');
            $category=$request->input('category');
            $shareStatus=$request->input('shareStatus');

//
//            $fp=fopen($newFileName, 'w');
//            fwrite($fp, $content);
//            fclose($fp);

            $newFileName=$user_id.$article_id."content.txt";

            Storage::disk('ftp')->append('content/'.$newFileName, $content);//保存到ftp上，Storage::disk('ftp')->append('/content/'.$newFileName, $content);

            $article=new Article();
            $article->id=$article_id;
            $article->share=$shareStatus;
            $article->user_id=$user_id;
            $article->title=$title;
            $article->content=$newFileName;
            $article->category=$category;
            $article->update=$update;
            $article->cover_url=$cover_url;
            $article->author=auth()->user()->name;

//            $data=[
//                "title"=>$title,
//                "content"=>$content,
//                "category"=>$category,
//                "user"=>$user_id,
//                "update"=>$update,
//                "share"=>$shareStatus
//            ];

            if(Cache::has('article:'.$article_id.':images')){
                $images = Cache::get('article:'.$article_id.':images');
                foreach($images as $img){
                    $img->valid=1;
                    $img->save();
                }
                Cache::forget('user:'.auth()->user()->id.':imageList');
                Cache::forget('article:'.$article_id.':images');
            }

            $article->save();

            DB::commit();

            return response()->json(['status'=>[1], 'msg'=>['upload success']]);

        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }



    public function comment(Request $request){
        $validator=Validator:: make($request->all(),[
            'content' => 'required',
        ]);
            $content = $request->input('content');
            $user_id = $request->input('user_id');
            $article_id=$request->input('article_id');
            date_default_timezone_set("PRC");
            $update = date('Y-m-d H:i:s', time());
            $comment=new Comment();
            $comment->user_id=$user_id;
            $comment->update=$update;
            $comment->content=$content;
            $comment->article_id=$article_id;
            $comment->save();
            return 1;
    }

    public function comment_reply(Request $request){
        $validator=Validator:: make($request->all(),[
            'content' => 'required',
        ]);
        $id=$request->input('id');
        $reply_name=$request->input('reply_name');
        $content = $request->input('content');
        $user_id = $request->input('user_id');
        $article_id=$request->input('article_id');
        date_default_timezone_set("PRC");
        $update = date('Y-m-d H:i:s', time());
        $reply=new Reply();
        $reply->id=$id;
        $reply->reply_name=$reply_name;
        $reply->user_id=$user_id;
        $reply->update=$update;
        $reply->content=$content;
        $reply->article_id=$article_id;
        $reply->save();
        return 1;
    }

    public function cover(Request $request){
        $validator=Validator:: make($request->all(),[
            'cover' => 'nullable|image',
        ]);

        if($validator->fails()){
            return $validator->errors()->add('status', 0);
        }

        //获取图片
        $image=$request->file('cover');

        //存储路径
        $destinatonPath='image/cover';

        //设置图片名
        $inputImageName='&'.auth()->user()->id.time().'.'.$image->getClientOriginalExtension();

        //存储图片
        $path=$image->storeAs($destinatonPath, $inputImageName);

        //返回文件名
        return $inputImageName;

        DB::beginTransaction();

        try {
            $cover=$request->file('cover');
            $user_id=auth()->user()->id;
            $article_id=$request->input('article_id');
            if($request->hasFile('cover')){
                $article=Article::find($article_id);
                $cover=$request->file('cover');
                $inputImageName = time() . '.' . $cover->getClientOriginalExtension();
                $destinatonPath = 'images/';
                $cover->move($destinatonPath, $inputImageName);

                $finalPath = '/' . $destinatonPath . $inputImageName;

                $previousAvatar = $article->cover_url;
                if ($previousAvatar != '/images/blog_cover.jpg') {
                    $previousAvatar = public_path() . $previousAvatar;
                    if (file_exists($previousAvatar)) {
                        unlink($previousAvatar);
                    }
                }

                $article->cover_url=$finalPath;
                $article->save();
            }
            DB::commit();
            return response()->json(['status'=>[1], 'msg'=>['cover uploaded success']]);

        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
