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
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ModelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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


        $img = imagecreatefromstring(Storage::disk('local')->get('image/raw/' . $http_src));

        $im2 = imagecrop($img, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);


        $imageName = auth()->user()->id . time() . rand(0, 100000) . '.png';
        $path = storage_path() . '/app/image/temp/' . $imageName;

        if ($im2 !== FALSE) {
            imagepng($im2, $path);

            Storage::disk('ftp')->putFileAs('image/processed', new File(storage_path().'/app/image/temp/' . $imageName), $imageName);//注意需要放在ftp服务器
            Storage::disk('local')->delete('image/temp/'.$imageName);

            imagedestroy($im2);
        }
        imagedestroy($img);

        return response()->json(['imageName' => $imageName]);

    }

    public function attnGan(Request $request)
    {
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
        $str = $request->input('str');
        $output = passthru("source activate attngan && cd /resources/AttnGAN/code && python fine.py --str $str --name ");
        //apache
        //$output = passthru("source activate attngan && cd AttnGAN/code && python fine.py --str $str");
        //$newName=time().'.png';
        //rename(public_path().'/AttnGAN/0_s_0_g2.png', public_path().'/images/a.png');
        return response()->json(['output' => $output]);
    }
}
