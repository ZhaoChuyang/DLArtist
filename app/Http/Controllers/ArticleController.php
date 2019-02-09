<?php

namespace DLArtist\Http\Controllers;

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
            'shareStatus'=>'required'
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

//            $data=[
//                "title"=>$title,
//                "content"=>$content,
//                "category"=>$category,
//                "user"=>$user_id,
//                "update"=>$update,
//                "share"=>$shareStatus
//            ];

            $article=new Article();
            $article->share=$shareStatus;
            $article->user_id=$user_id;
            $article->title=$title;
            $article->content=$content;
            $article->category=$category;
            $article->update=$update;
            $article->save();
            DB::commit();
            return response()->json(['status'=>[1], 'msg'=>['upload success']]);

        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
