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
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\InputStream;

class ModelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function BingImageSearch(Request $request){
        // Replace with a valid subscription key from your Azure account.
        $accessKey = 'fc57283355aa4fbfa62702ae298044cb';
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

    public function sendArticle($id,$plan_id){
        $article_id=Crypt::decrypt($id);
        $article=new Article();
        $user_id=auth()->user()->id;
        $user_name=auth()->user()->name;
        date_default_timezone_set("PRC");
        $update=date('Y-m-d H:i:s',time());
        $content=$article->where('id',$article_id)->get();
        if($plan_id==1){
            return view('article_mode1',compact('content','user_name','update'));
        }else if($plan_id==2){
            return view('article_mode2',compact('content','user_name','update'));
        }else if($plan_id==3){
            return view('article_mode3',compact('content','user_name','update'));
        }
    }

    public function encrypt(Request $request){
        $data=$request->input('data');
        return Crypt::encrypt($data);
    }

    public function crop_pic(Request $request){
        $x=$request->input('x');
        $y=$request->input('y');
        $width=$request->input('width');
        $height=$request->input('height');
        $http_src =$request->input('src');
        $path = substr($http_src, 21);
        $img = imagecreatefromstring(file_get_contents(public_path() . $path));
        $im2 = imagecrop($img, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);
        $name=public_path() .'/images/'.time().'.png';
        if ($im2 !== FALSE) {
            imagepng($im2, $name);
            imagedestroy($im2);
        }
        imagedestroy($img);
        $name=substr($name,-22);
        sleep(1);
        return response()->json(['name'=>$name]);

    }

    public function attnGan(Request $request){
//        $input = new InputStream();
//        $input->write('一只红色的猫');
//        //'/anaconda3/envs/attngan/bin/python','fine.py','--str','一只红色的猫'
//        $process = new Process(['ls','.']);
//        $process->setInput($input);
//        $process->start();

// ... read process output or do other things

        //$input->write('bar');
//        $input->close();
//
//        $process->wait();
// will echo: foobar
//        echo $process->getOutput();
//
//        // executes after the command finishes
//        if (!$process->isSuccessful()) {
//            throw new ProcessFailedException($process);
//        }

        //echo $process->getOutput();
//        echo shell_exec('source activate attngan && ');
        //swoole
        $str=$request->input('str');
        $output=passthru("source activate attngan && cd /resources/AttnGAN/code && python fine.py --str $str --name ");
        //apache
        //$output = passthru("source activate attngan && cd AttnGAN/code && python fine.py --str $str");
        //$newName=time().'.png';
        //rename(public_path().'/AttnGAN/0_s_0_g2.png', public_path().'/images/a.png');
        return response()->json(['output'=>$output]);
    }
}
