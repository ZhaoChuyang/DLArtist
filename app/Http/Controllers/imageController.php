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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;



class imageController extends Controller
{

    static public $category_collection=[17, 18, 7, 16, 11, 11, 11, 3, 7, 0, 14, 11, 19, 7, 17, 6, 15, 11, 11, 11, 1, 15, 10, 17, 4, 6, 14, 15, 0, 18, 17, 17, 17, 12, 15, 4, 14, 7, 12, 0, 14, 100, 4, 14, 10, 7, 9, 15, 15, 15, 0, 0, 17, 16, 0, 7, 16, 12, 0, 0, 7, 14, 0, 11, 20, 8, 0, 0, 14, 16, 1, 6, 17, 20, 20, 17, 12, 7, 15, 11, 8, 13, 11, 0, 7, 14, 20, 0, 0, 20, 0, 11, 0, 0, 8, 6, 4, 0, 8, 13, 7, 8, 8, 8, 0, 15, 17, 6, 11, 0, 0, 17, 13, 7, 19, 4, 1, 0, 0, 13, 0, 14, 6, 10, 15, 0, 17, 17, 0, 19, 19, 15, 19, 0, 17, 20, 7, 9, 0, 7, 8, 9, 7, 15, 7, 19, 15, 20, 0, 17, 17, 6, 0, 16, 0, 0, 0, 15, 6, 15, 19, 15, 0, 1, 7, 15, 7, 12, 0, 7, 4, 20, 0, 19, 9, 15, 18, 18, 15, 12, 11, 9, 17, 4, 19, 17, 7, 19, 8, 12, 0, 20, 20, 4, 4, 7, 17, 11, 16, 14, 13, 17, 4, 14, 10, 0, 17, 11, 6, 1, 13, 0, 19, 18, 19, 16, 8, 14, 12, 19, 20, 11, 11, 11, 16, 19, 0, 15, 13, 10, 16, 17, 20, 17, 11, 0, 17, 4, 10, 8, 7, 7, 0, 15, 15, 15, 16, 9, 13, 19, 17, 20, 14, 8, 16, 12, 0];

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
        $inputImageName=']'.auth()->user()->id.time().'.'.$image->getClientOriginalExtension();

        //目标地址
        $destinatonPath='image/raw';

        //存图片，获取地址
        $path=$image->storeAs($destinatonPath, $inputImageName);//记住改成ftp服务器,添加第三个参数'ftp', 错误

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
        preg_match('/].*/', $src, $match, PREG_OFFSET_CAPTURE);
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

        //清理redis中的文章图片缓存
        $max_article_id=Cache::get('max_article_id');

        for($i=1; $i<=$max_article_id; $i++){
            if(Cache::has('article:'.$i.':images')){
                $images=Cache::get('article:'.$i.':images');
                Cache::forget('article:'.$i.':images');
                foreach($images as $img){
                    if($img->valid==0){
                        $url=$img->image_url;
                        $url='image/raw/'.$url;
                        Storage::delete($url);
                    }
                }
            }
        }

    }

    public function imageClassify(Request $request){

        $category_collection=[17, 18, 7, 16, 11, 11, 11, 1, 7, 0, 14, 11, 19, 7, 17, 6, 15, 11, 11, 11, 1, 15, 10, 17, 4, 6, 14, 15, 0, 18, 17, 17, 17, 12, 15, 4, 14, 7, 12, 0, 14, 20, 4, 14, 10, 7, 9, 15, 15, 15, 0, 0, 17, 16, 0, 7, 16, 12, 0, 0, 7, 14, 0, 11, 20, 8, 0, 0, 14, 16, 1, 6, 17, 20, 20, 17, 12, 7, 15, 11, 8, 13, 11, 0, 7, 14, 20, 0, 0, 20, 0, 11, 0, 0, 8, 6, 4, 0, 8, 13, 7, 8, 8, 8, 0, 15, 17, 6, 11, 0, 0, 17, 13, 7, 19, 4, 1, 0, 0, 13, 0, 14, 6, 10, 15, 0, 17, 17, 0, 19, 19, 15, 19, 0, 17, 20, 7, 9, 0, 7, 8, 9, 7, 15, 7, 19, 15, 20, 0, 17, 17, 6, 0, 16, 0, 0, 0, 15, 6, 15, 19, 15, 0, 1, 7, 15, 7, 12, 0, 7, 4, 20, 0, 19, 9, 15, 18, 18, 15, 12, 11, 9, 17, 4, 19, 17, 7, 19, 8, 12, 0, 20, 20, 4, 4, 7, 17, 11, 16, 14, 13, 17, 4, 14, 10, 0, 17, 11, 6, 1, 13, 0, 19, 18, 19, 16, 8, 14, 12, 19, 20, 11, 11, 11, 16, 19, 0, 15, 13, 10, 16, 17, 20, 17, 11, 0, 17, 4, 10, 8, 7, 7, 0, 15, 15, 15, 16, 9, 13, 19, 17, 20, 14, 8, 16, 12, 0];
        $category_map=["动物", "人","","", "昆虫", "", "植物", "家具,日用", "音乐", "自然", "宗教", "体育", "娱乐,游戏", "食物", "食品用具","电子用品,电器", "外饰", "交通", "武器", "工具","建筑"];

        $validator = Validator:: make($request->all(), [
            'article_id'=>'required|not_in:0',
            'src'=>'required',
            'category'=>'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->add('status', 0);
        }

        $article_id=$request->input('article_id');

        $src=$request->input('src');

        $match=array();

        //正则匹配出url中的地址字段
        preg_match('/].*/', $src, $match, PREG_OFFSET_CAPTURE);
        $src=$match[0][0];

        $category=$request->input('category');

        $images = Cache::get('article:'.$article_id.':images');

        for($i=0; $i<sizeof($images); $i++){
            if($images[$i]->image_url==$src){
                Log::info("category:$category, collection:$category_collection[$category], i:$i");
                $images[$i]->category=$category_map[$category_collection[$category]];
                Cache::forget('article:'.$article_id.':images');
                Cache::put('article:'.$article_id.':images', $images, 1440);
                return $images[$i]->category;
            }
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
            $data['tag']=$img->category;
            $dataCollection[$i]=$data;
            $i++;
        }
        return response()->json($dataCollection);
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

    public function recommendImage(Request $request){





        $query_item = $request->input('query_item');

        $pexels = new \Glooby\Pexels\Client("563492ad6f91700001000001fe0fbc76846d443c8b6d865a166f9c90");
        $response = $pexels->search($query_item);

        $photos = json_decode($response->getBody())->photos;

        return $photos;

    }
}
