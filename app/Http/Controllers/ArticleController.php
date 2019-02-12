<?php

namespace DLArtist\Http\Controllers;

use DLArtist\DB\Comment;
use Illuminate\Http\Request;
use DLArtist\DB\Article;
use Validator;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('edit');
    }

    public function store(Request $request)
    {
        $validator=Validator:: make($request->all(),[
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
            date_default_timezone_set("PRC");
            $update=date('Y-m-d H:i:s',time());
            $content=$request->input('content');
            $category=$request->input('category');
            $shareStatus=$request->input('shareStatus');

            $article=new Article();
            $article->share=$shareStatus;
            $article->user_id=$user_id;
            $article->title=$title;
            $article->content=$content;
            $article->category=$category;
            $article->update=$update;




//            $data=[
//                "title"=>$title,
//                "content"=>$content,
//                "category"=>$category,
//                "user"=>$user_id,
//                "update"=>$update,
//                "share"=>$shareStatus
//            ];



            $article->save();
            DB::commit();
            return response()->json(['status'=>[1], 'msg'=>['upload success'], 'article_id'=>$article->id]);

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

    public function cover(Request $request){
        $validator=Validator:: make($request->all(),[
            'cover' => 'nullable|image',
            'article_id'=>'required'
        ]);

        if($validator->fails()){
            return $validator->errors()->add('status', 0);
        }

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
