<?php

namespace DLArtist\Http\Controllers;

use DLArtist\DB\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DLArtist\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use DLArtist\image;

class ModelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function BingImageSearch(Request $request){
        // Replace with a valid subscription key from your Azure account.
        $accessKey = '3f478837b17641d8bfef316abc8355b1';
        $endpoint = 'https://api.cognitive.microsoft.com/bing/v7.0/images/search';
        $term = $request->input('query');
        function BingImageSearch ($url, $key, $query) {
            /*
             * Prepare the HTTP request.
             * NOTE: Use the key 'http' even if you are making an HTTPS request.
             * See: http://php.net/manual/en/function.stream-context-create.php.
             */
            // Perform the request and receive a response.
            $headers = "Ocp-Apim-Subscription-Key: $key\r\n";
            $options = array ( 'http' => array (
                'header' => $headers,
                'method' => 'GET' ));
            // Perform the request and receive a response.
            $context = stream_context_create($options);
            $result = file_get_contents($url . "?q=" . urlencode($query), false, $context);
            // Extract Bing HTTP headers.
            $headers = array();
            $num=0;
            foreach ($http_response_header as $k => $v) {
                $h = explode(":", $v, 2);
                if (isset($h[1])){
                    if (preg_match("/^BingAPIs-/", $h[0]) || preg_match("/^X-MSEdge-/", $h[0])){
                        $headers[trim($h[0])] = trim($h[1]);
                    }
                }
            }
            return array($headers, $result);
        }
// Validate the subscription key.
        if (strlen($accessKey) == 32) {
            // Makes the request.
            list($headers, $json) = BingImageSearch($endpoint, $accessKey, $term);
            // Prints JSON encoded response.
//            print "\nJSON Response:\n\n";
            return $json;

        } else {
            //print("Invalid Bing Search API subscription key!\n");
            //print("Please paste yours into the source code.\n");
        }
    }

    public function sendArticle($id){
        $article_id=Crypt::decrypt($id);
        $article=new Article();
        $user_id=auth()->user()->id;
        $user_name=auth()->user()->name;
        date_default_timezone_set("PRC");
        $update=date('Y-m-d H:i:s',time());
        $content=$article->where('id',$article_id)->get();
        return view('article_mode1',compact('content','user_name','update'));
    }

    public function encrypt(Request $request){
        $data=$request->input('data');
        return Crypt::encrypt($data);
    }

//    public function crop_pic(Request $request){
//        $this->validate($request, [
//            'img'=>'required|image|max:10240'
//        ]);
//        $image=$request->file('img');
//        $inputImageName=time().'.'.$image->getClientOriginalExtension();
//        $destinatonPath='images/';
//        $image->move($destinatonPath, $inputImageName);
//        $img = new image;
//        $img->image_url=url("/images/$inputImageName");
//        $user_id=auth()->user()->id;
//        $img->user_id=$user_id;
//        $img->save();
//
//        $fin_width=$request->get('fin_width');
//        $fin_height=$request->get('fin_height');
//        $x=$request->get('x');
//        $y=$request->get('y');
//        $width=$request->get('width');
//        $height=$request->get('height');
//        $source=imagecreatefromjpeg("http://127.0.0.1:8000/images/$inputImageName");
//        $croped=imagecreatetruecolor($fin_width, $fin_height);
//        imagecopy($croped, $source, 0, 0, , $y, $width, $height);
//
//        $inputImageName=time().'.'.$croped->getClientOriginalExtension();
//        $destinatonPath='images/';
//        $croped->move($destinatonPath, $inputImageName);
//        $img = new image;
//        $img->image_url=url("/images/$inputImageName");
//        $user_id=auth()->user()->id;
//        $img->user_id=$user_id;
//        $img->save();
//        return 1;
//
//    }
}
