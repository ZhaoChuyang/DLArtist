<?php

namespace DLArtist\Http\Controllers;

use DLArtist\image;
use DLArtist\DB\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DLArtist\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


class imageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        //验证请求
        $this->validate($request, [
            'image'=>'required|image|max:10240',
            'article_id'=>'required|not_in:0',
        ]);

        //获取图片和文章id
        $image=$request->file('image');
        $article_id=$request->input('article_id');

        //设置图片名
        $inputImageName='&'.auth()->user()->id.time().'.'.$image->getClientOriginalExtension();

        //目标地址
        $destinatonPath='image/raw';

        //存图片，获取地址
        $path=$image->storeAs($destinatonPath, $inputImageName);//记住改成ftp服务器,添加第三个参数'ftp'

        //图片对象
        $img = new image();
        $img->image_url=$inputImageName;
        $user_id=auth()->user()->id;
        $img->user_id=$user_id;
        $img->valid=0;
        $img->article_id=$article_id;

        $images=array();

        //先将图片按各自从属的文章存到cache里面，最后一起保存到数据库
        if(!Cache::has('article:'.$article_id.':images')){
            array_push($images, $img);
            Cache::put('article:'.$article_id.':images', $images, 1440);
        }else{
            $images=Cache::get('article:'.$article_id.':images');
            array_push($images, $img);
            Cache::put('article:'.$article_id.':images', $images, 1440);
        }

        //返回指向地址的json
        return response()->json(['link' => url("/image/raw/$inputImageName")]);

    }

    public function destroy(Request $request)
    {
        $this->validate($request,[
            'src'=>'required'
        ]);
        $src=$request->input('src');

        $match=array();

        //正则匹配出url中的地址字段
        preg_match('/&.*/', $src, $match, PREG_OFFSET_CAPTURE);
        $src=$match[0][0];

        //图片设置为无效，之后一并删除
        $user_id=auth()->user()->id;
        $img=image::where('image_url', $src)->update(['valid'=>false]);
        Cache::forget('user:'.$user_id.':imageList');

        return "image deleted";
    }

    public function cleanImages(){
        //定时一起删除本地文件
        $all_deserted_img=image::where('valid', 0)->get();

        foreach($all_deserted_img as $deserted_img){
            $url=$deserted_img->image_url;
            $url='image/raw/'.$url;
            Storage::delete($url);
        }
    }

    public function list(Request $request){

        $user_id=auth()->user()->id;
        $data=[];
        //获取用户现在所有图片
        $dataCollection=[];
        $i=0;
        //将取到的结果存在cache中
        $images_in_db=Cache::remember('user:'.$user_id.':imageList', 1440, function(){
            return DB::table('images')->where('valid', 1)->where('user_id', auth()->user()->id)->get();
        });
        //$images_in_db=image::where('valid', 1)->where('user_id', $user_id)->get();
        foreach($images_in_db as $img){
            $image_name=$img->image_url;
            $url=url('/image/raw/'.$image_name);
            $data['url']=$url;
            $data['thumb']=$url;
            $dataCollection[$i]=$data;
            $i++;
        }
        return response()->json($dataCollection);
    }

    public function classify(Request $request){
        $validator = Validator:: make($request->all(), [
            'src'=>'required',
            'class'=>'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->add('status', 0);
        }

        $src=$request->input('src');
        $class=$request->input('class');

        if($class=='person')
            $class='person';
        else if($class=='bicycle')
            $class='traffic';
        else if($class=='car')
            $class='traffic';
        else if($class=='motorcycle')
            $class='traffic';
        else if($class=='airplane')
            $class='traffic';
        else if($class=='bus')
            $class='traffic';
        else if($class=='train')
            $class='traffic';
        else if($class=='truck')
            $class='traffic';
        else if($class=='boat')
            $class='traffic';
        else if($class=='traffic light')
            $class='traffic';
        else if($class=='fire hydrant')
            $class='traffic';
        else if($class=='stop sign')
            $class='traffic';
        else if($class=='parking meter')
            $class='traffic';
        else if($class=='bench')
            $class='item';
        else if($class=='bird')
            $class='animal';
        else if($class=='cat')
            $class='animal';
        else if($class=='dog')
            $class='animal';
        else if($class=='horse')
            $class='animal';
        else if($class=='sheep')
            $class='animal';
        else if($class=='cow')
            $class='animal';
        else if($class=='elephant')
            $class='animal';
        else if($class=='bear')
            $class='animal';
        else if($class=='zebra')
            $class='animal';
        else if($class=='giraffe')
            $class='animal';
        else if($class=='backpack')
            $class='item';
        else if($class=='umbrella')
            $class='item';
        else if($class=='handbag')
            $class='item';
        else if($class=='tie')
            $class='item';
        else if($class=='suitcase')
            $class='bicycle';
        else if($class=='frisbee')
            $class='item';
        else if($class=='skis')
            $class='item';
        else if($class=='snowboard')
            $class='item';
        else if($class=='sports ball')
            $class='item';
        else if($class=='kite')
            $class='item';
        else if($class=='baseball bat')
            $class='item';
        else if($class=='baseball glove')
            $class='item';
        else if($class=='skateboard')
            $class='item';
        else if($class=='surfboard')
            $class='item';
        else if($class=='tennis racket')
            $class='item';
        else if($class=='bottle')
            $class='item';
        else if($class=='wine glass')
            $class='item';
        else if($class=='cup')
            $class='item';
        else if($class=='fork')
            $class='item';
        else if($class=='knife')
            $class='item';
        else if($class=='spoon')
            $class='item';
        else if($class=='bowl')
            $class='item';
        else if($class=='banana')
            $class='food';
        else if($class=='apple')
            $class='food';
        else if($class=='sandwich')
            $class='food';
        else if($class=='orange')
            $class='food';
        else if($class=='broccoli')
            $class='food';
        else if($class=='carrot')
            $class='food';
        else if($class=='hot dog')
            $class='food';
        else if($class=='pizza')
            $class='food';
        else if($class=='donut')
            $class='food';
        else if($class=='cake')
            $class='food';
        else if($class=='chair')
            $class='item';
        else if($class=='couch')
            $class='item';
        else if($class=='potted plant')
            $class='item';
        else if($class=='bed')
            $class='item';
        else if($class=='dining table')
            $class='item';
        else if($class=='tv')
            $class='item';
        else if($class=='laptop')
            $class='item';
        else if($class=='mouse')
            $class='item';
        else if($class=='remote')
            $class='item';
        else if($class=='keyboard')
            $class='item';
        else if($class=='cell phone')
            $class='food';
        else if($class=='microwave')
            $class='food';
        else if($class=='oven')
            $class='food';
        else if($class=='toaster')
            $class='food';
        else if($class=='sink')
            $class='food';
        else if($class=='refrigerator')
            $class='item';
        else if($class=='book')
            $class='item';
        else if($class=='clock')
            $class='item';
        else if($class=='vase')
            $class='item';
        else if($class=='scissors')
            $class='item';
        else if($class=='teddy bear')
            $class='item';
        else if($class=='hair drier')
            $class='item';
        else if($class=='toothbrush')
            $class='item';

        DB::beginTransaction();

        try {
            $img=image::where('image_url', $src)->update(['category'=>$class]);
            DB::commit();
            return response()->json("image class uploaded");
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function imageManagement(Request $request){
        $user_id=auth()->user()->id;
        $images=image::where('valid', 1)->where('user_id', $user_id)->get();
        $data=[];
        $dataCollection=[];
        $i=0;
        foreach ($images as $img){
            $data['src']=$img->image_url;
            $data['class']=$img->category;
            $dataCollection[$i++]=$data;
        }
        return $dataCollection;
    }

    public function saveAttn(Request $request){
        $newName=time().'.png';
        rename(resource_path().'/AttnGAN/images/0_s_0_g2.png', public_path().'/images/'.$newName);
        $img = new image;

        $img->image_url=url("/images/".$newName);

        $user_id=auth()->user()->id;

        $img->user_id=$user_id;

        $img->save();

        return url("/images/".$newName);
    }
}
