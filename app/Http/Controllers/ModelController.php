<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use DLArtist\DB\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DLArtist\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use DLArtist\image;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\InputStream;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use \Gumlet\ImageResize;

class ModelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function BingImageSearch(Request $request)
    {
        // Replace with a valid subscription key from your Azure account.
        $accessKey = 'fc57283355aa4fbfa62702ae298044cb';
        $endpoint = 'https://api.cognitive.microsoft.com/bing/v7.0/images/search';
        $term = $request->input('query');
        function BingImageSearch($url, $key, $query)
        {
            /*
             * Prepare the HTTP request.
             * NOTE: Use the key 'http' even if you are making an HTTPS request.
             * See: http://php.net/manual/en/function.stream-context-create.php.
             */
            // Perform the request and receive a response.
            $headers = "Ocp-Apim-Subscription-Key: $key\r\n";
            $options = array('http' => array(
                'header' => $headers,
                'method' => 'GET'));
            // Perform the request and receive a response.
            $context = stream_context_create($options);
            $result = file_get_contents($url . "?q=" . urlencode($query), false, $context);
            // Extract Bing HTTP headers.
            $headers = array();
            $num = 0;
            foreach ($http_response_header as $k => $v) {
                $h = explode(":", $v, 2);
                if (isset($h[1])) {
                    if (preg_match("/^BingAPIs-/", $h[0]) || preg_match("/^X-MSEdge-/", $h[0])) {
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

    public function sendArticle($id, $plan_id)
    {
        $article_id = Crypt::decrypt($id);
        $article = new Article();
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        date_default_timezone_set("PRC");
        $update = date('Y-m-d H:i:s', time());
        $content = $article->where('id', $article_id)->get();
        if ($plan_id == 1) {
            return view('article_mode1', compact('content', 'user_name', 'update'));
        } else if ($plan_id == 2) {
            return view('article_mode2', compact('content', 'user_name', 'update'));
        } else if ($plan_id == 3) {
            return view('article_mode3', compact('content', 'user_name', 'update'));
        }
    }

    public function encrypt(Request $request)
    {
        $data = $request->input('data');
        return Crypt::encrypt($data);
    }

    public function crop_pic(Request $request)
    {
        //裁剪图片
        $x = $request->input('x');
        $y = $request->input('y');
        $width = $request->input('width');
        $height = $request->input('height');
        $http_src = $request->input('src');

        $match = array();
        //正则匹配出url中的地址字段
        preg_match('/].*/', $http_src, $match, PREG_OFFSET_CAPTURE);
        $http_src = $match[0][0];

        $imageName = auth()->user()->id . time() . rand(0, 100000) . '.jpg';
        $image = new ImageResize(storage_path().'/app/image/raw/'.$http_src);
        $image->freecrop($width, $height, $x, $y);
        $image->save(storage_path().'/app/image/temp/'.$imageName);

        $path = storage_path() . '/app/image/temp/' . $imageName;

        Storage::disk('ftp')->putFileAs('image/processed', new File(storage_path().'/app/image/temp/' . $imageName), $imageName);//注意需要放在ftp服务器
        //Storage::disk('local')->delete('image/temp/'.$imageName);

        return response()->json(['imageName' => $imageName]);

    }

    public function genSummary(Request $request){
        $validator=Validator:: make($request->all(),[
            'content'=>'required',
        ]);

        if($validator->fails()){
            return $validator->errors()->add('status', 0);
        }

        $content=$request->input('content');

        $newFileName=auth()->user()->id.time().'.txt';

        $path=storage_path().'/app/summary/'.$newFileName;

        Storage::disk('local')->append('summary/'.$newFileName, $content);

        //swoole环境需更换
        $output=shell_exec("cd ../resources/TextRank && python main.py $path");

        return $output;

    }

    public function attnGan(Request $request)
    {

        $str = $request->input(('str'));
        $name = $request->input('name');

        //swoole
        //$output = shell_exec("source activate attngan && cd resources/AttnGAN/code && python fine.py --str $str --name ");

        //apache
        $output = shell_exec("source activate attngan && cd ../resources/AttnGAN/code && python fine.py --str $str --name $name");

        return response()->json(['output' => $output]);
    }

//    public function calcColor(){
//        $myR=0;
//        $myG=0;
//        $myB=0;
//
//        $allColor=[[254,150,170],[100,54,60],[244,167,185],[248,195,205],[142,53,74],[225,107,140],[220,159,180],[208,16,76],[158,122,122],[254,223,225],[219,77,109],[208,90,110],[232,122,144],[181,73,91],[235,122,119],[144,72,64],[171,59,58],[203,64,66],[169,99,96],[149,74,69],[241,124,103],[185,136,125],[181,68,52],[153,70,57],[85,66,54],[199,62,58],[199,62,58],[204,84,58],[163,94,71],[133,72,54],[181,93,76],[215,84,85],[232,48,21],[136,76,58],[251,150,110],[175,95,60],[196,98,67],[154,80,52],[106,64,40],[247,92,47],[114,72,50],[114,73,56],[180,113,87],[219,142,113],[240,94,28],[237,120,74],[202,120,83],[179,92,55],[251,153,102],[193,105,60],[160,103,75],[240,169,134],[143,90,60],[227,145,110],[86,63,46],[148,122,109],[163,99,53],[231,148,96],[125,83,44],[199,133,80],[152,95,42],[225,166,121],[150,99,46],[177,120,68],[233,163,104],[233,139,42],[255,186,132],[252,159,77],[133,91,50],[67,52,27],[202,122,44],[236,184,138],[120,85,43],[176,119,54],[150,114,73],[226,148,59],[182,142,85],[130,102,58],[215,185,142],[235,180,113],[110,85,47],[155,110,35],[199,128,45],[188,159,119],[135,102,51],[193,138,38],[255,177,27],[209,152,38],[221,165,45],[201,102,51],[218,201,166],[125,108,70],[247,194,66],[232,182,71],[186,145,50],[220,184,121],[249,191,69],[250,214,137],[217,171,66],[246,197,85],[255,196,8],[239,187,36],[202,173,95],[141,116,42],[134,120,53],[108,96,36],[162,140,55],[116,103,62],[137,125,85],[135,127,108],[180,165,130],[98,89,44],[233,105,76],[247,217,76],[251,226,81],[217,205,144],[173,161,66],[221,210,59],[97,97,56],[177,180,121],[131,138,45],[147,150,80],[108,106,45],[190,194,63],[165,160,81],[75,78,42],[91,98,46],[77,81,57],[137,145,107],[144,180,75],[145,173,112],[181,202,160],[145,180,147],[81,110,65],[66,96,45],[74,89,61],[134,193,102],[123,162,63],[100,106,88],[128,143,124],[27,129,62],[93,172,129],[54,86,60],[34,125,81],[168,216,185],[106,131,114],[32,96,79],[9,97,72],[0,137,108],[134,166,151],[36,147,110],[70,93,76],[45,109,75],[15,76,58],[79,114,108],[0,170,144],[105,176,172],[38,69,61],[102,186,183],[38,135,133],[102,153,161],[119,150,154],[165,222,228],[58,107,109],[120,194,196],[48,90,86],[64,91,85],[129,199,212],[51,166,184],[12,72,66],[13,86,97],[0,137,167],[51,103,116],[37,83,89],[46,92,110],[58,143,183],[43,95,117],[88,178,220],[87,124,138],[86,108,155],[30,136,168],[0,98,132],[125,185,222],[81,168,221],[46,169,223],[11,16,19],[15,37,64],[8,25,45],[78,79,151],[17,50,133],[38,30,71],[110,117,164],[123,144,210],[11,52,110],[0,92,175],[33,30, 85],[139,129,195],[155,144,194],[138,107,190],[106,76,156],[143,119,181],[102,50,124],[74, 34 ,93],[60,47,65],[119,66,141],[152,109,178],[178,143,209],[83, 61, 91],[89, 44, 99], [111, 51, 129], [87, 76, 87],[180, 129, 187], [63, 43, 54], [87, 42, 63], [94, 61, 80], [224,60, 138], [86,46,55],[168, 73, 122],[193, 50, 142],[109, 46, 91], [98,41, 84], [114, 99, 110], [96, 55, 62], [252, 250, 242], [255, 255, 251], [182, 192, 186],[145, 152, 159], [120, 120, 120], [130, 130, 130], [120, 125, 123],[112, 124, 116], [101, 103, 101], [83, 89, 83], [79,79,72], [82, 67, 61], [55, 60, 56], [58, 50, 38], [67, 67, 67], [28, 28, 28], [8,8,8], [12, 12, 12]];
//
//        $fileName='11155668498766357.png';
//
//        $path=storage_path().'/app/image/processed/'.$fileName;
//
//        //apache
//        $output=shell_exec("cd ../resources/kmeans && python color.py $path");
//        //swoole
//        //$output=shell_exec("cd /resources/kmeans && python color.py $path");
//
//        $myColor=[];
//        $p=0;
//        $num=0;
//        //return $output;
//        for($i=1; $i<strlen($output); $i++){
//            if($output[$i]<='9' && $output[$i]>='0'){
//                $digit=(int)$output[$i];
//                $num=$num*10+$digit;
//            }else{
//                $myColor[$p++]=$num;
//                $num=0;
//                $i++;
//            }
//        }
//
//        $color_1=0;
//        $color_2=0;
//        $color_3=0;
//
//        $tempMin=0x3f3f3f3f;
//
//        for($i=0; $i<sizeof($allColor); $i++){
//            $sum=($allColor[$i][0]-$myColor[0])*($allColor[$i][0]-$myColor[0])+($allColor[$i][1]-$myColor[1])*($allColor[$i][1]-$myColor[1])+($allColor[$i][2]-$myColor[2])*($allColor[$i][2]-$myColor[2]);
//            if($sum<$tempMin){
//                $color_1=$i;
//                $tempMin=$sum;
//            }
//        }
//
//        $tempMin=0x3f3f3f3f;
//
//        for($i=0; $i<sizeof($allColor); $i++){
//            $sum=($allColor[$i][0]-$myColor[0])*($allColor[$i][0]-$myColor[0])+($allColor[$i][1]-$myColor[1])*($allColor[$i][1]-$myColor[1])+($allColor[$i][2]-$myColor[2])*($allColor[$i][2]-$myColor[2]);
//            if($sum<$tempMin && $i!=$color_1){
//                $color_2=$i;
//                $tempMin=$sum;
//            }
//        }
//
//        $tempMin=0x3f3f3f3f;
//
//        for($i=0; $i<sizeof($allColor); $i++){
//            $sum=($allColor[$i][0]-$myColor[0])*($allColor[$i][0]-$myColor[0])+($allColor[$i][1]-$myColor[1])*($allColor[$i][1]-$myColor[1])+($allColor[$i][2]-$myColor[2])*($allColor[$i][2]-$myColor[2]);
//            if($sum<$tempMin && $i!=$color_1 && $i!=$color_2){
//                $color_3=$i;
//                $tempMin=$sum;
//            }
//        }
//
//        return $allColor[$color_2];
//
//    }
}
