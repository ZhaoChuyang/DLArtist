<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use SoapClient;
use Illuminate\Support\Facades\Log;
use Crew;

class TypeSettingController extends Controller
{
    public function strip_html_tags($tags, $str)
    {
        $html = '/<' . $tags . '.*?><\/' . $tags . '>/';
        $data = preg_replace($html,'', $str);
        return $data;
    }

    public function re_duplicate($a)
    {
        for($i=1;$i<sizeof($a);$i++){
            $pre=$a[$i-1];$lat=$a[$i];
            if($pre->chose == $lat->chose){
                array_splice($a, $i-1, 1);$i--;
            }
        }
        return $a;
    }

    function cal_text_num($model){
        if($model==1){
            return 3700;
        }
        else if($model==2){
            return 2398;
        }
        else if($model==3){
            return 255;
        }
        else if($model==4){
            return 1900;
        }
        else if($model==5){
            return 2698;
        }
        else if($model==6){
            return 2040;
        }
        else if($model==7){
            return 4192;
        }
        else if($model==8){
            return 2592;
        }
        else if($model==9){
            return 3415;
        }
        return 0;
    }
    function cal_image_num($model){
        if($model==6||$model==2||$model==8||$model==9){
            return 2;
        }
        else if($model==1)
            return 0;
        else if($model==3){
            return 3;
        }
        else return 1;
    }

    function re_cmp_text($a, $b)
    {
        if ($a->text_num == $b->text_num) {
            return 0;
        }
        return ($a->text_num < $b->text_num) ? -1 : 1;
    }

    function return_last_page($template, $n)
    {
        while($template>=$n){
            $template=(int)($template/$n);
        }
        return $template;
    }

    public function return_unique_page($template, $n)
    {
        $temp=array();
        while($template){
            $save=$template%$n;
            $template=(int)($template/$n);
            array_push($temp,$save);
        }
        return count(array_unique($temp));
    }

    public function return_max_score($a, $b)
    {
        if ($a->score == $b->score) {
            return ($a->chose>$b->chose) ? 1 : -1;
        }
        return ($a->score < $b->score) ? 1 : -1;
    }

    public function encoder($final_answer, $n)
    {
        $recommend=array();
        for ($i=0;$i<sizeof($final_answer);$i++){
            $answer=new ans();
            $answer->chose=$final_answer[$i];
            while($final_answer[$i]>0){
                $model=$final_answer[$i]%$n;
                $final_answer[$i]=(int)($final_answer[$i]/$n);
                $answer->text_num+=$this->cal_text_num($model);
                $answer->image_num+=$this->cal_image_num($model);
            }
            array_push($recommend,$answer);
        }
        return $recommend;
    }

    function penalty($recommend,$last,$text_num,$img_num,$n)
    {
        //text_num
        $token = $text_num;
        for ($i = 0; $i < sizeof($recommend); $i++) {
            if($recommend[$i]->text_num - $token>0)
                $recommend[$i]->score -= (int)(($recommend[$i]->text_num - $token) / 200);
            else
                $recommend[$i]->score-=999;
        }
        //image_number
        for ($i = 0; $i < sizeof($recommend); $i++) {
            $r = $recommend[$i]->image_num - $img_num;
            if ($r >= 0) {
                $recommend[$i]->score -= $r * 6;
            } else {
                $recommend[$i]->score -= 999;
            }
        }

        for ($i = 0; $i < sizeof($recommend); $i++) {
            if ($recommend[$i]->score < 0) {
                array_splice($recommend, $i, 1);
                $i--;
            }
        }

        //last_text
        for ($i = 0; $i < sizeof($recommend); $i++) {
            $type = $this->return_last_page($recommend[$i]->chose, $n);
            if (!in_array($type, $last)) {
                array_splice($recommend, $i, 1);
                $i--;
            }
        }


        //template_multiple
        for ($i = 0; $i < sizeof($recommend); $i++) {
            $mul = $this->return_unique_page($recommend[$i]->chose, $n);
            $recommend[$i]->score += $mul * 3;
        }
        usort($recommend, function ($a,$b){
            if ($a->score == $b->score) {
                return ($a->chose>$b->chose) ? 1 : -1;
            }
            return ($a->score < $b->score) ? 1 : -1;
        });
        return $recommend;
    }


    public function convert_dlartist($recommend, $n)
    {
        $temp_chose=array();
        $j=0;
        for($i=0;$i<sizeof($recommend);$i++){
            $chose=new choose();
            $first_flag=true;
            $inner_first_flag=true;
            $ans=$recommend[$i]->chose;
            while($ans>0){
                if($first_flag){
                    $first_flag=false;
                    $chose->first_chosen=$ans%$n;
                    $ans=(int)($ans/$n);
                }
                else{
                    if($inner_first_flag){
                        $inner_first_flag=false;
                        array_push($chose->inner_chosen,$ans%$n);
                        $ans=(int)($ans/$n);
                    }
                    else{
                        $chose->inner_chosen[$j]*=$n;
                        $chose->inner_chosen[$j]+=$ans%$n;;
                        $ans=(int)($ans/$n);
                    }
                }
                array_push($temp_chose,$chose);
            }
        }
        return $temp_chose;
    }

    public function typesetting($word_count, $imgNum, $hasSummary, $summary = "")
    {
        $n = 10;

        $model_1 = new first_template();
        $model_1->text_number = 3700;
        $model_1->type = 1;
        $model_1->image_number = 0;

        $model_2 = new first_template();
        $model_2->text_number = 2398;
        $model_2->type = 2;
        $model_2->image_number = 2;
        $model_2->image_h[0] = 54.9;
        $model_2->image_w[0] = 83.6;
        $model_2->image_h[1] = 54.9;
        $model_2->image_w[1] = 83.6;

        $model_3 = new first_template();
        $model_3->text_number =255;
        $model_3->type = 3;
        $model_3->image_number = 3;
        $model_3->image_h[0] = 76.621;
        $model_3->image_w[0] = 108.116;
        $model_3->image_h[1] = 70.89;
        $model_3->image_w[1] = 76.45;
        $model_3->image_h[2] = 70.89;
        $model_3->image_w[2] = 76.45;

        $model_4 = new first_template_no_summary();
        $model_4->text_number = 1900;
        $model_4->type = 4;
        $model_4->image_number = 1;
        $model_4->image_h[0] = 106.681;
        $model_4->image_w[0] = 123.209;

        $model_5 = new first_template_no_summary();
        $model_5->text_number = 2698;
        $model_5->type = 5;
        $model_5->image_number =1;
        $model_5->image_h[0] = 85.527;
        $model_5->image_w[0] = 77.988;
//---------------------------------------------------------
        $model_6 = new inner_template();
        $model_6->text_number = 2040;
        $model_6->type = 6;
        $model_6->image_number = 2;
        $model_6->image_h[0] =139.73;
        $model_6->image_w[0] =134.402;
        $model_6->image_h[1] =107.389;
        $model_6->image_w[1] =134.402;
//---------------------------------------------------------
        $model_7 = new inner_template();
        $model_7->text_number = 4192;
        $model_7->type = 7;
        $model_7->image_number = 1;
        $model_7->image_h[0] = 68.7;
        $model_7->image_w[0] = 69.2;
        //---------------------------------------------------------
        $model_8 = new inner_template();
        $model_8->text_number = 2592;
        $model_8->type = 8;
        $model_8->image_number = 2;
        $model_8->image_h[0] = 128;
        $model_8->image_w[0] = 77.5;
        $model_8->image_h[1] = 102.143;
        $model_8->image_w[1] = 87.5;
        //---------------------------------------------------------
        $model_9 = new inner_template();
        $model_9->text_number = 3415;
        $model_9->type = 9;
        $model_9->image_number = 2;
        $model_9->image_h[0] =68.429;
        $model_9->image_w[0] =78.5;
        $model_9->image_h[1] =104.918;
        $model_9->image_w[1] =88;



//-----------------------------------------------------------------------------------------------------------------------
        $text_num = $word_count;
        $img_num = $imgNum;
        $flag = $hasSummary;

        $template = array();
        array_push($template, $model_1, $model_2, $model_3, $model_4, $model_5, $model_6, $model_7,$model_8,$model_9);
        $first_and_summary = array();
        array_push($first_and_summary, $model_1, $model_2, $model_3);
        $first_and_no_summary = array();
        array_push($first_and_no_summary, $model_4, $model_5);
        $inner = array();
        array_push($inner, $model_6, $model_7,$model_8,$model_9);
        $last = array();
        array_push($last,$model_1->type,$model_2->type,$model_3->type,$model_4->type,$model_5->type,$model_7->type);


        $remainder_text = $text_num;
        $temp_chose = array();
        //first page
        if ($flag) {
            uasort($first_and_summary, function ($a, $b) {
                if ($a->text_number == $b->text_number) {
                    return 0;
                }
                return ($a->text_number < $b->text_number) ? -1 : 1;
            });
            foreach ($first_and_summary as $tplt) {
                if ($remainder_text >= $tplt->text_number * 0.85){
                    $chose = new choose();
                    $chose->remainder = $remainder_text - $tplt->text_number;
                    $chose->first_chosen = $tplt->type;
                    if ($chose->remainder <= 0) $chose->inner_flag = 0;
                    else $chose->inner_flag = 1;
                    array_push($temp_chose, $chose);
                } else break;
            }
            if (sizeof($temp_chose) == 0) {
                return 0;
            }//the text are too few
        } else {
            uasort($first_and_no_summary, function ($a, $b) {
                if ($a->text_number == $b->text_number) {
                    return 0;
                }
                return ($a->text_number < $b->text_number) ? -1 : 1;
            });
            foreach ($first_and_no_summary as $tplt) {
                if ($remainder_text >= $tplt->text_number * 0.85) {
                    $chose = new choose();
                    $chose->remainder = $remainder_text - $tplt->text_number;
                    $chose->first_chosen = $tplt->type;
                    if ($chose->remainder <= 0) $chose->inner_flag = 0;
                    else $chose->inner_flag = 1;
                    array_push($temp_chose, $chose);
                } else break;
            }
            if (sizeof($temp_chose) == 0) {
                return 0;
            }//the text are too few
        }
        //
        //inner page
        foreach ($temp_chose as $temp) {
            if ($temp->inner_flag) {
                $times = 15;
                $recover = $temp->remainder;
                for ($i = 0; $i < max(sizeof($inner), $times--); $i++) {
                    $tag = true;
                    while ($temp->remainder > 0) {
                        $index = rand(0, sizeof($inner) - 1);
                        if ($tag) {
                            $temp->inner_chosen[14 - $times] = $inner[$index]->type;
                            $tag = false;
                        } else {
                            $temp->inner_chosen[14 - $times] *= $n;
                            $temp->inner_chosen[14 - $times] += $inner[$index]->type;
                        }
                        $temp->remainder -= $inner[$index]->text_number;
                    }
                    $temp->remainder = $recover;
                }
            }
        }
        //
        //Hybridization
        $final_answer = array();
        $Hybridization = intval(($text_num / 20000)) + 1;
        $ans = new ans();
        $ans->score = 0;
        $result = array();
        Log::info("开始计算排版");
        while ($Hybridization--) {
            Log::info("排版循环进行".$Hybridization);
            for ($k = 0; $k < sizeof($temp_chose); $k++) {
                for ($i = 0; $i < sizeof($temp_chose); $i++) {
                    if(sizeof($temp_chose[$i]->inner_chosen)==0){
                        array_push($final_answer, $temp_chose[$i]->first_chosen);
                    }
                    else{
                        for ($j = 0; $j < sizeof($temp_chose[$i]->inner_chosen);) {
                            $last_page=$temp_chose[$i]->inner_chosen[$j];
                            while($last_page>$n){
                                $last_page=(int)($last_page/$n);
                            }
                            if($last_page!=7){
                                //print_r($last_page);print_r("\n");
                            }
                            else{
                                array_push($final_answer, $temp_chose[$i]->inner_chosen[$j] * $n + $temp_chose[$k]->first_chosen);
                            }
                            $pace=rand(1, 1);
                            $j+=$pace;
                        }
                    }
                }
            }
            //fitness function
            $recommend=$this->encoder($final_answer,$n);
            $recommend=$this->penalty($recommend,$last,$text_num,$img_num,$n);
            //remove duplicate
            $recommend=$this->re_duplicate($recommend);
            //selection
            if(sizeof($recommend))array_push($result,$recommend[0]);
            //transform and do Hybridization again
            $temp_chose=$this->convert_dlartist($recommend,$n);

        }
        for ($i = 0; $i < sizeof($recommend); $i++) {
            array_push($result, $recommend[$i]);
        }
        for ($i = 0; $i < sizeof($result); $i++) {
            if (sizeof($result) && $ans->score < $result[$i]->score) $ans = $result[$i];
        }
        if ($ans->score) {
            $image = array();
            $ch = $ans->chose;

            while ($ch) {
                $q = $ch % $n;
                $ch = (int)($ch / $n);
                if ($q == 1) {
                    for ($i = 0; $i < $model_1->image_number; $i++) {
                        $image_cell = [];
                        array_push($image_cell, $model_1->image_h[$i]);
                        array_push($image_cell, $model_1->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if ($q == 2) {
                    for ($i = 0; $i < $model_2->image_number; $i++) {
                        $image_cell = [];
                        array_push($image_cell, $model_2->image_h[$i]);
                        array_push($image_cell, $model_2->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if ($q == 3) {
                    for ($i = 0; $i < $model_3->image_number; $i++) {
                        $image_cell = [];
                        array_push($image_cell, $model_3->image_h[$i]);
                        array_push($image_cell, $model_3->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if ($q == 4) {
                    for ($i = 0; $i < $model_4->image_number; $i++) {
                        $image_cell = [];
                        array_push($image_cell, $model_4->image_h[$i]);
                        array_push($image_cell, $model_4->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if ($q == 5) {
                    for ($i = 0; $i < $model_5->image_number; $i++) {
                        $image_cell = [];
                        array_push($image_cell, $model_5->image_h[$i]);
                        array_push($image_cell, $model_5->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if ($q == 6) {
                    for ($i = 0; $i < $model_6->image_number; $i++) {
                        $image_cell = [];
                        array_push($image_cell, $model_6->image_h[$i]);
                        array_push($image_cell, $model_6->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if ($q == 7) {
                    for ($i = 0; $i < $model_7->image_number; $i++) {
                        $image_cell = [];
                        array_push($image_cell, $model_7->image_h[$i]);
                        array_push($image_cell, $model_7->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if ($q == 8) {
                    for ($i = 0; $i < $model_8->image_number; $i++) {
                        $image_cell = [];
                        array_push($image_cell, $model_8->image_h[$i]);
                        array_push($image_cell, $model_8->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if ($q == 9) {
                    for ($i = 0; $i < $model_9->image_number; $i++) {
                        $image_cell = [];
                        array_push($image_cell, $model_9->image_h[$i]);
                        array_push($image_cell, $model_9->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
            }
            return array('chose' => $ans->chose, "image" => $image);
        }
    }

    public function compose_pro(Request $request){

        $article_id = $request->input('article_id');

        $article = null;

        if (Cache::has('article:' . $article_id)) {
            $article = Cache::get('article:' . $article_id);
        } else {
            $article = DB::table('articles')->find($article_id);
            Cache::put('article:' . $article_id, $article, 1440);
        }

        //待传参数
        $doDebug = false;



        $title = $article->title;
        $content_path = $article->content;

        $o_content = Storage::disk('ftp')->get('content/' . $content_path);//换成ftp


        $images = $request->input('images');
        $image_num = sizeof($images);
        $R = "";
        $G = "";
        $B = "";
        $imageString = "";


        foreach ($images as $img) {

            $colors = $this->calcColor($img);

            for ($i = 0; $i < 3; $i++) {
                $R = $R . 'q' . strval($colors[$i][0]);
                $G = $G . 'q' . strval($colors[$i][1]);
                $B = $B . 'q' . strval($colors[$i][2]);
            }

            $imageString = $imageString . "q/C/Users/Administrator/Desktop/ftp/image/processed/" . $img;
            Log::info("imageString:".$imageString."\n");

        }

        Log::info("color generated:\tR:" . $R . "\tG:" . $G . "\tB:" . $B);

        //服务器地址
        $myHost = 'http://192.168.43.6:12345';
        //wsdl地址
        $myWSDL = "$myHost/Service?wsdl";
        //script地址
        $myScriptFile = resource_path() . '/js/newspaperTemplate.js';
        //脚本语言
        $myScriptLanguage = "javascript";
        //脚本内容
        $myScriptText = '';

        $filePath="/C/Users/Administrator/Desktop/ftp/pdf/$article_id.pdf";

        //传参
        $myScriptArgs = array();
        $myScriptArgs[0] = array('name' => 'chose', 'value' => $chose);
        $myScriptArgs[1] = array('name' => 'get_image_num', 'value' => $image_num);
        $myScriptArgs[2] = array('name' => 'get_pic', 'value' => $imageString);
        $myScriptArgs[3] = array('name' => 'R', 'value' => $R);
        $myScriptArgs[4] = array('name' => 'G', 'value' => $G);
        $myScriptArgs[5] = array('name' => 'B', 'value' => $B);
        $myScriptArgs[6] = array('name' => 'text_title', 'value' => $title);
        $myScriptArgs[7] = array('name' => 'text_author', 'value' => $author);
        $myScriptArgs[8] = array('name' => 'text_content', 'value' => $content);
        $myScriptArgs[9] = array('name' => 'text_summary', 'value' => $summary);
        $myScriptArgs[10] = array('name'=> 'file_path', 'value' => $filePath);

        //读入script内容
//        $fh = fopen($myScriptFile, 'r');
//        $theSize = filesize($myScriptFile);
//        if ($theSize > 0) {
//            $myScriptText = fread($fh, $theSize);
//        } else {
//            $myScriptText = '';
//        }
//        fclose($fh);

        $myScriptText = File::get(resource_path('js/newspaperTemplate.js'));
        //return $myScriptText;
        // send script file path as empty since we're sending the text of the script
        $myScriptFile = '';

        // CALL RunScript
        $myResult = $this->phpRunScript($myWSDL, $myHost, $myScriptFile, $myScriptText, $myScriptLanguage, $myScriptArgs, $doDebug);
        return $myResult;

    }

    public function main(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'article_id' => 'required|not_in:0',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->add('status', 0);
        }

        $article_id = $request->input('article_id');








        /****/




//        $client = new \GuzzleHttp\Client();
//
//        Log::info("开始调用unsplashAPI");
//        try{
//            $response = $client->request('GET', "https://api.unsplash.com/search/photos?page=1&per_page=9&query=$targetCategory&client_id=bba13fe0c315149a698934336d8d07041d71bcdd0fa4dedd7f52549f455769e6");
//        }
//        catch(\Exception $ex){
//            Log::info($ex);
//            $response = $client->request('GET', "https://api.unsplash.com/search/photos?page=1&per_page=9&query=$targetCategory&client_id=bba13fe0c315149a698934336d8d07041d71bcdd0fa4dedd7f52549f455769e6");
//        }
//        Log::info("调用unsplashAPI结束");
//        $data = json_decode($response->getBody(), true);

//        $photos_1=$data['results'];


        $user_id = auth()->user()->id;

        $article = null;

        if (Cache::has('article:' . $article_id)) {
            $article = Cache::get('article:' . $article_id);
        } else {
            $article = DB::table('articles')->find($article_id);
            Cache::put('article:' . $article_id, $article, 720);
        }

        $content_path = $article->content;

        $o_content = Storage::disk('ftp')->get('content/' . $content_path);//换成ftp

        //$o_content=$request->input('content');
        preg_match_all('/<img[^>]*?src="([^"]*?)"[^>]*?>/i', $o_content, $img);
        $img_num = sizeof($img[1]);




        $o_content=str_replace("<strong>",'$st$',$o_content);
        $o_content=str_replace("</strong>",'$/s$',$o_content);
        $content = htmlspecialchars_decode($o_content);
        $content = str_replace("&#39;", "'", $content);
        $content = str_replace("&nbsp;", " ", $content);
        $content = strip_tags($content, '<p>');
        $content = $this->strip_html_tags("p", $content);
        $content = str_replace("\n", "", $content);
        $content = str_replace("</p>", "\n", $content);
        $content = strip_tags($content, '');

        Storage::disk('ftp')->delete('content/' . $content_path);//换成ftp
        Storage::disk('ftp')->append('content/' . $content_path, $content);//换成ftp

        $num = mb_strwidth($content, 'utf8') * 1.3;

        $needSummary = $article->needSummary;

        $summary = "";

        if ($needSummary) {
            $summary = $article->summary;
        }
        $title = $article->title;
        $author = $article->author;


        if(Cache::has($article_id.':addImage')&&Cache::get($article_id.':addImage')) {

            $img_num += 2;
            Log::info("图片".$img_num);
        }

        $ans = $this->typesetting($num, $img_num, $needSummary, $summary);

        $while_limit=5;
        while($ans==0){
            if($while_limit--==0) break;
            $ans=$this->typesetting($num, $img_num, $needSummary, $summary);
        }

        $times = 10;

        while ($ans == "" && $times--)
            $ans = $this->typesetting($num, $img_num, $needSummary, $summary);

        if($ans==0){
            response()->json(['ans' => $ans, 'image_path' => $img, ]);
        }

        Log::info("cache:".Cache::get($article_id.':addImage'));
        if(Cache::has($article_id.':addImage')&&Cache::get($article_id.':addImage')!=0){


            $imageCategory = $request->input('imageCategory');
            Log::info('imageCate'.$imageCategory);
            define("CURL_TIMEOUT", 2000);
            define("URL", "http://openapi.youdao.com/api");
            define("APP_KEY", "65cb2721b205bcf0"); // 替换为您的应用ID
            define("SEC_KEY", "NzBBQGswxIkikUlVxHPxbhXzMbVfcovw"); // 替换为您的密钥

            $ret = $this->do_request($imageCategory);
            $ret = json_decode($ret, true);
            $targetCategory = $ret["translation"][0];

            $pexels = new \Glooby\Pexels\Client("563492ad6f91700001000001fe0fbc76846d443c8b6d865a166f9c90");
            $response = $pexels->search($targetCategory);
            $response_1 = $response;

            $photos = json_decode($response->getBody())->photos;



            $totalNeedImageNum=sizeof($ans['image']);
            $totalHaveImageNum=sizeof($img[1]);
            Log::info('needImage:'.$totalHaveImageNum."\thaveImage:$totalHaveImageNum");

            $unsplash_index=0;
            foreach($photos as $photo){

                if($totalHaveImageNum==$totalNeedImageNum) break;
                Log::info("开始下载unsplash图片");
                try{



                    $ch = curl_init ();
                    curl_setopt ( $ch, CURLOPT_ENCODING, '' ); // if you're downloading files that benefit from compression (like .bmp images), this line enables compressed transfers.


                    $url = $photo->src->medium;
                    $name = ']'.$user_id.time();
                    $path = storage_path()."/app/image/raw/";

                    $imgname = $name . ".png";
                    $imagename=$imgname;
                    $imgname=fopen($path.$imgname,'wb');
                    curl_setopt_array ( $ch, array (
                        CURLOPT_URL => $url,
                        CURLOPT_FILE => $imgname
                    ) );
                    curl_exec ( $ch );
                    fclose($imgname);
                    // file_put_contents ( $img, file_get_contents ( $url ) );

                    curl_close ( $ch );

//                $ctx = stream_context_create(array(
//                        'http' => array(
//                            'timeout' => 7
//                        )
//                    )
//                );
//                $url = $photo['urls']['regular'];
//                $contents=file_get_contents($url);
//
//                $name = ']'.$user_id.time().'.png';
//                file_put_contents(storage_path().'/app/image/raw/'.$name, $contents);

                    if(filesize($path.$imagename)!=0){
                        array_push($img[1], url("/image/raw/$imagename"));
                        $totalHaveImageNum++;
                    }
                    Log::info(url("/image/raw/$imagename"));

                }catch(\Exception $e){
                    Log::alert('下载出错-'.$e);
//                try{
//                    $ctx = stream_context_create(array(
//                            'http' => array(
//                                'timeout' => 7
//                            )
//                        )
//                    );
//                    $url=$photos_1[$unsplash_index++]['urls']['regular'];
//                    $contents = file_get_contents($url,0, $ctx);
//                    $name = ']'.$user_id.time().'.png';
//                    file_put_contents(storage_path().'/app/image/raw/'.$name, $contents);
//                    array_push($img[1], url('/image/raw/'.$name));
//                }catch(\Exception $e){
//                    Log::info('下载出错');
//                    break;
//                }
                    continue;
                }
            }
        }

//        $needImageNum = sizeof($ans->image);
//
//        $residentImage = $needImageNum - sizeof($img[1]);
//
//        $images = Cache::get('article:'.$article_id.':images');
//        for($i=0; $i<sizeof($images); $i++){
//            if($images[$i]->image_url==$img[1][0]){
//                $images[$i]->category=$category_map[$category_collection[$category]];
//                Cache::forget('article:'.$article_id.':images');
//                Cache::put('article:'.$article_id.':images', $images, 1440);
//                return $images[$i]->category;
//            }
//        }
//        if(Cache::has())
//
//        $targetImage = $img[1][0];

//        $newImagePack=array();
//        for($k=0; $k<sizeof($ans['image']); $k++) array_push($newImagePack, null);
//
//        foreach($img[1] as $image){
//
//            $match=array();
//
//            //正则匹配出url中的地址字段
//            preg_match('/].*/', $image, $match, PREG_OFFSET_CAPTURE);
//            $src=$match[0][0];
//
//            $size = getimagesize(storage_path().'/app/image/raw/'.$src);
//            list($width, $height)=$size;
//
//            $http_src=$image;
//
//            $used=0;
//
//
//            for($j=0; $j<sizeof($ans['image']); $j++){
//                if($ans['image'][$j][0]>$ans['image'][$j][1] && $height>$width && $newImagePack[$j]==null){//h>w
//
//                    $newImagePack[$j]=$image;
//                    break;
//                }
//            }
//            for($j=0; $j<sizeof($ans['image']); $j++){
//                if($ans['image'][$j][0]<$ans['image'][$j][1] && $height<$width && $newImagePack[$j]==null){//h>w
//
//                    $newImagePack[$j]=$image;
//                    break;
//                }
//            }
//
//        }
//
//        for($i=0; $i<sizeof($ans['image']); $i++){
//            Log::info('save pexel image');
//            if($newImagePack[$i]==null){
//                foreach ($photos as $photo) {
//                    try{
//                        if($photo->width>$photo->height && $ans['image'][$i][0]<$ans['image'][$i][1]){
//
//                            $url = $photo->src->medium;
//                            $contents = file_get_contents($url);
//                            $name = ']'.$user_id.time().'.png';
//                            file_put_contents(storage_path().'/app/image/raw/'.$name, $contents);
//                            $newImagePack[$j]=url('/image/raw/'.$name);
//                            break;
//                        }
//                        if($photo->width<$photo->height && $ans['image'][$i][0]>$ans['image'][$i][1]){
//
//                            $url = $photo->src->medium;
//                            $contents = file_get_contents($url);
//                            $name = ']'.$user_id.time().'.png';
//                            file_put_contents(storage_path().'/app/image/raw/'.$name, $contents);
//                            $newImagePack[$j]=url('/image/raw/'.$name);
//                            break;
//                        }
//                    }catch(\Exception $e){
//                        Log::alert('下载出错'.$e);
//                        continue;
//                    }
//
//                }
//            }
//        }





        return response()->json(['ans' => $ans, 'image_path' => $img]);

    }



    public function testfanyi()
    {



        define("CURL_TIMEOUT", 2000);
        define("URL", "http://openapi.youdao.com/api");
        define("APP_KEY", "65cb2721b205bcf0"); // 替换为您的应用ID
        define("SEC_KEY", "NzBBQGswxIkikUlVxHPxbhXzMbVfcovw"); // 替换为您的密钥

        // 输入
        $q = "海上生明月";

        $ret = $this->do_request($q);
        $ret = json_decode($ret, true);

        $targetCategory = $ret["translation"][0];
        //echo 1;
        //echo $targetCategory;



        $pexels = new \Glooby\Pexels\Client("563492ad6f91700001000001fe0fbc76846d443c8b6d865a166f9c90");
        $response = $pexels->search("night");

        $photos = json_decode($response->getBody())->photos;

        foreach($photos as $photo){

            Log::info("开始下载unsplash图片");
            try{



                $ch = curl_init ();
                curl_setopt ( $ch, CURLOPT_ENCODING, '' ); // if you're downloading files that benefit from compression (like .bmp images), this line enables compressed transfers.


                $url = $photo->src->medium;
                $name = ']'.time();
                $path = storage_path()."/app/image/raw/";

                $imgname = $name . ".png";
                $imagename=$imgname;
                $imgname=fopen($path.$imgname,'wb');
                curl_setopt_array ( $ch, array (
                    CURLOPT_URL => $url,
                    CURLOPT_FILE => $imgname
                ) );
                curl_exec ( $ch );
                fclose($imgname);
                // file_put_contents ( $img, file_get_contents ( $url ) );

                curl_close ( $ch );

//                $ctx = stream_context_create(array(
//                        'http' => array(
//                            'timeout' => 7
//                        )
//                    )
//                );
//                $url = $photo['urls']['regular'];
//                $contents=file_get_contents($url);
//
//                $name = ']'.$user_id.time().'.png';
//                file_put_contents(storage_path().'/app/image/raw/'.$name, $contents);

                if(filesize($path.$imagename)!=0){
                }
                Log::info(url("/image/raw/$imagename"));

            }catch(\Exception $e){
                Log::alert('下载出错-'.$e);
//                try{
//                    $ctx = stream_context_create(array(
//                            'http' => array(
//                                'timeout' => 7
//                            )
//                        )
//                    );
//                    $url=$photos_1[$unsplash_index++]['urls']['regular'];
//                    $contents = file_get_contents($url,0, $ctx);
//                    $name = ']'.$user_id.time().'.png';
//                    file_put_contents(storage_path().'/app/image/raw/'.$name, $contents);
//                    array_push($img[1], url('/image/raw/'.$name));
//                }catch(\Exception $e){
//                    Log::info('下载出错');
//                    break;
//                }
                continue;
            }
        }

        return $photos;


        foreach($photos_1 as $photo){
            $urls=$photo['urls'];
            print_r($urls['regular']."\n");
        }
        print_r("**********\n");
        $pexels = new \Glooby\Pexels\Client("563492ad6f91700001000001fe0fbc76846d443c8b6d865a166f9c90");
        $response = $pexels->search($targetCategory);

        $photos = json_decode($response->getBody())->photos;

        foreach($photos as $photo){
            $url = $photo->src->medium;
            print_r($url."\n");
        }
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_ENCODING, '' ); // if you're downloading files that benefit from compression (like .bmp images), this line enables compressed transfers.


        $url = $photo['urls']['regular'];
        $name = ']'.auth()->user()->id.time().'.png';
        $path = storage_path()."/app/image/raw/";

        $img = $name . ".png";
        $img=fopen($img,'wb');
        curl_setopt_array ( $ch, array (
            CURLOPT_URL => $url,
            CURLOPT_FILE => $img
        ) );
        curl_exec ( $ch );
        fclose($img);
        // file_put_contents ( $img, file_get_contents ( $url ) );

        curl_close ( $ch );
    }


    function do_request($q)
    {
        $salt = $this->create_guid();
        $args = array(
            'q' => $q,
            'appKey' => APP_KEY,
            'salt' => $salt,
        );
        $args['from'] = 'zh-CHS';
        $args['to'] = 'EN';
        $args['signType'] = 'v3';
        $curtime = strtotime("now");
        $args['curtime'] = $curtime;
        $signStr = APP_KEY . $this->truncate($q) . $salt . $curtime . SEC_KEY;
        $args['sign'] = hash("sha256", $signStr);
        $ret = $this->call(URL, $args);
        return $ret;
    }

// 发起网络请求
    function call($url, $args = null, $method = "post", $testflag = 0, $timeout = CURL_TIMEOUT, $headers = array())
    {
        $ret = false;
        $i = 0;
        while ($ret === false) {
            if ($i > 1)
                break;
            if ($i > 0) {
                sleep(1);
            }
            $ret = $this->callOnce($url, $args, $method, false, $timeout, $headers);
            $i++;
        }
        return $ret;
    }

    function callOnce($url, $args = null, $method = "post", $withCookie = false, $timeout = CURL_TIMEOUT, $headers = array())
    {
        $ch = curl_init();
        if ($method == "post") {
            $data = $this->convert($args);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST, 1);
        } else {
            $data = $this->convert($args);
            if ($data) {
                if (stripos($url, "?") > 0) {
                    $url .= "&$data";
                } else {
                    $url .= "?$data";
                }
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($withCookie) {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $_COOKIE);
        }
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }

    function convert(&$args)
    {
        $data = '';
        if (is_array($args)) {
            foreach ($args as $key => $val) {
                if (is_array($val)) {
                    foreach ($val as $k => $v) {
                        $data .= $key . '[' . $k . ']=' . rawurlencode($v) . '&';
                    }
                } else {
                    $data .= "$key=" . rawurlencode($val) . "&";
                }
            }
            return trim($data, "&");
        }
        return $args;
    }

// uuid generator
    function create_guid()
    {
        $microTime = microtime();
        list($a_dec, $a_sec) = explode(" ", $microTime);
        $dec_hex = dechex($a_dec * 1000000);
        $sec_hex = dechex($a_sec);
        $this->ensure_length($dec_hex, 5);
        $this->ensure_length($sec_hex, 6);
        $guid = "";
        $guid .= $dec_hex;
        $guid .= $this->create_guid_section(3);
        $guid .= '-';
        $guid .= $this->create_guid_section(4);
        $guid .= '-';
        $guid .= $this->create_guid_section(4);
        $guid .= '-';
        $guid .= $this->create_guid_section(4);
        $guid .= '-';
        $guid .= $sec_hex;
        $guid .= $this->create_guid_section(6);
        return $guid;
    }

    function create_guid_section($characters)
    {
        $return = "";
        for ($i = 0; $i < $characters; $i++) {
            $return .= dechex(mt_rand(0, 15));
        }
        return $return;
    }

    function truncate($q)
    {
        $len = strlen($q);
        return $len <= 20 ? $q : (substr($q, 0, 10) . $len . substr($q, $len - 10, $len));
    }

    function ensure_length(&$string, $length)
    {
        $strlen = strlen($string);
        if ($strlen < $length) {
            $string = str_pad($string, $length, "0");
        } else if ($strlen > $length) {
            $string = substr($string, 0, $length);
        }
    }


    public function connectInDesign(Request $request)
    {

        $validator = Validator:: make($request->all(), [
            'images' => 'required',
            'article_id' => 'required|not_in:0',
            'chose' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->add('status', 0);
        }


        $article_id = $request->input('article_id');

        $article = null;

        if (Cache::has('article:' . $article_id)) {
            $article = Cache::get('article:' . $article_id);
        } else {
            $article = DB::table('articles')->find($article_id);
            Cache::put('article:' . $article_id, $article, 1440);
        }

        //待传参数
        $doDebug = false;
        $chose = $request->input('chose');
        $author = $article->author;
        $summary = $article->summary;
        $title = $article->title;
        $content = '/C/Users/Administrator/Desktop/ftp/content/' . $article->content;

        $images = $request->input('images');
        $image_num = sizeof($images);
        $R = "";
        $G = "";
        $B = "";
        $imageString = "";


        foreach ($images as $img) {

            $colors = $this->calcColor($img);

            for ($i = 0; $i < 3; $i++) {
                $R = $R . 'q' . strval($colors[$i][0]);
                $G = $G . 'q' . strval($colors[$i][1]);
                $B = $B . 'q' . strval($colors[$i][2]);
            }

            $imageString = $imageString . "q/C/Users/Administrator/Desktop/ftp/image/processed/" . $img;
            Log::info("imageString:".$imageString."\n");

        }

        Log::info("color generated:\tR:" . $R . "\tG:" . $G . "\tB:" . $B);

        //服务器地址
        $myHost = 'http://192.168.43.6:12345';
        //wsdl地址
        $myWSDL = "$myHost/Service?wsdl";
        //script地址
        $myScriptFile = resource_path() . '/js/newspaperTemplate.js';
        //脚本语言
        $myScriptLanguage = "javascript";
        //脚本内容
        $myScriptText = '';

        $filePath="/C/Users/Administrator/Desktop/ftp/pdf/$article_id.pdf";

        //传参
        $myScriptArgs = array();
        $myScriptArgs[0] = array('name' => 'chose', 'value' => $chose);
        $myScriptArgs[1] = array('name' => 'get_image_num', 'value' => $image_num);
        $myScriptArgs[2] = array('name' => 'get_pic', 'value' => $imageString);
        $myScriptArgs[3] = array('name' => 'R', 'value' => $R);
        $myScriptArgs[4] = array('name' => 'G', 'value' => $G);
        $myScriptArgs[5] = array('name' => 'B', 'value' => $B);
        $myScriptArgs[6] = array('name' => 'text_title', 'value' => $title);
        $myScriptArgs[7] = array('name' => 'text_author', 'value' => $author);
        $myScriptArgs[8] = array('name' => 'text_content', 'value' => $content);
        $myScriptArgs[9] = array('name' => 'text_summary', 'value' => $summary);
        $myScriptArgs[10] = array('name'=> 'file_path', 'value' => $filePath);

        //读入script内容
//        $fh = fopen($myScriptFile, 'r');
//        $theSize = filesize($myScriptFile);
//        if ($theSize > 0) {
//            $myScriptText = fread($fh, $theSize);
//        } else {
//            $myScriptText = '';
//        }
//        fclose($fh);

        $myScriptText = File::get(resource_path('js/newspaperTemplate.js'));
        //return $myScriptText;
        // send script file path as empty since we're sending the text of the script
        $myScriptFile = '';

        // CALL RunScript
        $myResult = $this->phpRunScript($myWSDL, $myHost, $myScriptFile, $myScriptText, $myScriptLanguage, $myScriptArgs, $doDebug);
        return $myResult;
    }


    private function phpRunScript($wsdl, $host, $scriptFile, $scriptText, $scriptLanguage, $scriptArgs, $printDebugInfo)
    {
        $result = '';

        try {
            // SOAP CLIENT
            // To target a specific instance of InDesign Server, you must modify the
            // host uri specified by the WSDL.  You can do this one of two ways:
            //		* edit the "SOAP:address location=" section of IDSP.wsdl, or
            //		* pass the target in the location parameter to SoapClient()
            // use trace to generate debug info; encoding set to utf-8; location overrides the WSDL's location

            if ($host != '') {
                $client = new SoapClient($wsdl, array('trace' => $printDebugInfo, 'encoding' => 'utf-8', 'location' => $host));
            } else {
                $client = new SoapClient($wsdl, array('trace' => $printDebugInfo, 'encoding' => 'utf-8'));
            }

            // CALL RunScript
            $scriptParams = array('scriptText' => $scriptText,
                'scriptLanguage' => $scriptLanguage,
                'scriptFile' => $scriptFile,
                'scriptArgs' => $scriptArgs);
            $runScriptParams = array('runScriptParameters' => $scriptParams);

            $result = $client->RunScript($runScriptParams);

            // DISPLAY RESULTS
            if ($printDebugInfo) {
                print_r($result);
            }

            // RELEASE the client
            unset($client);

        } catch (SoapFault $exception) {
            if ($printDebugInfo) {
                print_r($exception);
            }
            $result = $exception;
        }

        return $result;
    }

    protected function calcColor($fileName)
    {

        $allColor = [[254, 150, 170], [100, 54, 60], [244, 167, 185], [248, 195, 205], [142, 53, 74], [225, 107, 140], [220, 159, 180], [208, 16, 76], [158, 122, 122], [254, 223, 225], [219, 77, 109], [208, 90, 110], [232, 122, 144], [181, 73, 91], [235, 122, 119], [144, 72, 64], [171, 59, 58], [203, 64, 66], [169, 99, 96], [149, 74, 69], [241, 124, 103], [185, 136, 125], [181, 68, 52], [153, 70, 57], [85, 66, 54], [199, 62, 58], [199, 62, 58], [204, 84, 58], [163, 94, 71], [133, 72, 54], [181, 93, 76], [215, 84, 85], [232, 48, 21], [136, 76, 58], [251, 150, 110], [175, 95, 60], [196, 98, 67], [154, 80, 52], [106, 64, 40], [247, 92, 47], [114, 72, 50], [114, 73, 56], [180, 113, 87], [219, 142, 113], [240, 94, 28], [237, 120, 74], [202, 120, 83], [179, 92, 55], [251, 153, 102], [193, 105, 60], [160, 103, 75], [240, 169, 134], [143, 90, 60], [227, 145, 110], [86, 63, 46], [148, 122, 109], [163, 99, 53], [231, 148, 96], [125, 83, 44], [199, 133, 80], [152, 95, 42], [225, 166, 121], [150, 99, 46], [177, 120, 68], [233, 163, 104], [233, 139, 42], [255, 186, 132], [252, 159, 77], [133, 91, 50], [67, 52, 27], [202, 122, 44], [236, 184, 138], [120, 85, 43], [176, 119, 54], [150, 114, 73], [226, 148, 59], [182, 142, 85], [130, 102, 58], [215, 185, 142], [235, 180, 113], [110, 85, 47], [155, 110, 35], [199, 128, 45], [188, 159, 119], [135, 102, 51], [193, 138, 38], [255, 177, 27], [209, 152, 38], [221, 165, 45], [201, 102, 51], [218, 201, 166], [125, 108, 70], [247, 194, 66], [232, 182, 71], [186, 145, 50], [220, 184, 121], [249, 191, 69], [250, 214, 137], [217, 171, 66], [246, 197, 85], [255, 196, 8], [239, 187, 36], [202, 173, 95], [141, 116, 42], [134, 120, 53], [108, 96, 36], [162, 140, 55], [116, 103, 62], [137, 125, 85], [135, 127, 108], [180, 165, 130], [98, 89, 44], [233, 105, 76], [247, 217, 76], [251, 226, 81], [217, 205, 144], [173, 161, 66], [221, 210, 59], [97, 97, 56], [177, 180, 121], [131, 138, 45], [147, 150, 80], [108, 106, 45], [190, 194, 63], [165, 160, 81], [75, 78, 42], [91, 98, 46], [77, 81, 57], [137, 145, 107], [144, 180, 75], [145, 173, 112], [181, 202, 160], [145, 180, 147], [81, 110, 65], [66, 96, 45], [74, 89, 61], [134, 193, 102], [123, 162, 63], [100, 106, 88], [128, 143, 124], [27, 129, 62], [93, 172, 129], [54, 86, 60], [34, 125, 81], [168, 216, 185], [106, 131, 114], [32, 96, 79], [9, 97, 72], [0, 137, 108], [134, 166, 151], [36, 147, 110], [70, 93, 76], [45, 109, 75], [15, 76, 58], [79, 114, 108], [0, 170, 144], [105, 176, 172], [38, 69, 61], [102, 186, 183], [38, 135, 133], [102, 153, 161], [119, 150, 154], [165, 222, 228], [58, 107, 109], [120, 194, 196], [48, 90, 86], [64, 91, 85], [129, 199, 212], [51, 166, 184], [12, 72, 66], [13, 86, 97], [0, 137, 167], [51, 103, 116], [37, 83, 89], [46, 92, 110], [58, 143, 183], [43, 95, 117], [88, 178, 220], [87, 124, 138], [86, 108, 155], [30, 136, 168], [0, 98, 132], [125, 185, 222], [81, 168, 221], [46, 169, 223], [11, 16, 19], [15, 37, 64], [8, 25, 45], [78, 79, 151], [17, 50, 133], [38, 30, 71], [110, 117, 164], [123, 144, 210], [11, 52, 110], [0, 92, 175], [33, 30, 85], [139, 129, 195], [155, 144, 194], [138, 107, 190], [106, 76, 156], [143, 119, 181], [102, 50, 124], [74, 34, 93], [60, 47, 65], [119, 66, 141], [152, 109, 178], [178, 143, 209], [83, 61, 91], [89, 44, 99], [111, 51, 129], [87, 76, 87], [180, 129, 187], [63, 43, 54], [87, 42, 63], [94, 61, 80], [224, 60, 138], [86, 46, 55], [168, 73, 122], [193, 50, 142], [109, 46, 91], [98, 41, 84], [114, 99, 110], [96, 55, 62], [252, 250, 242], [255, 255, 251], [182, 192, 186], [145, 152, 159], [120, 120, 120], [130, 130, 130], [120, 125, 123], [112, 124, 116], [101, 103, 101], [83, 89, 83], [79, 79, 72], [82, 67, 61], [55, 60, 56], [58, 50, 38], [67, 67, 67], [28, 28, 28], [8, 8, 8], [12, 12, 12]];

        $path = storage_path() . '/app/image/temp/' . $fileName;

        //apache
        $output = shell_exec("cd ../resources/kmeans && python color.py $path");
        //swoole
        //$output=shell_exec("cd /resources/kmeans && python color.py $path");

        $myColor = [];
        $p = 0;
        $num = 0;
        //return $output;
        for ($i = 1; $i < strlen($output); $i++) {
            if ($output[$i] <= '9' && $output[$i] >= '0') {
                $digit = (int)$output[$i];
                $num = $num * 10 + $digit;
            } else {
                $myColor[$p++] = $num;
                $num = 0;
                $i++;
            }
        }

        $color_1 = 0;
        $color_2 = 0;
        $color_3 = 0;

        $tempMin = 0x3f3f3f3f;

        for ($i = 0; $i < sizeof($allColor); $i++) {
            $sum = ($allColor[$i][0] - $myColor[0]) * ($allColor[$i][0] - $myColor[0]) + ($allColor[$i][1] - $myColor[1]) * ($allColor[$i][1] - $myColor[1]) + ($allColor[$i][2] - $myColor[2]) * ($allColor[$i][2] - $myColor[2]);
            if ($sum < $tempMin) {
                $color_1 = $i;
                $tempMin = $sum;
            }
        }

        $tempMin = 0x3f3f3f3f;

        for ($i = 0; $i < sizeof($allColor); $i++) {
            $sum = ($allColor[$i][0] - $myColor[0]) * ($allColor[$i][0] - $myColor[0]) + ($allColor[$i][1] - $myColor[1]) * ($allColor[$i][1] - $myColor[1]) + ($allColor[$i][2] - $myColor[2]) * ($allColor[$i][2] - $myColor[2]);
            if ($sum < $tempMin && $i != $color_1) {
                $color_2 = $i;
                $tempMin = $sum;
            }
        }

        $tempMin = 0x3f3f3f3f;

        for ($i = 0; $i < sizeof($allColor); $i++) {
            $sum = ($allColor[$i][0] - $myColor[0]) * ($allColor[$i][0] - $myColor[0]) + ($allColor[$i][1] - $myColor[1]) * ($allColor[$i][1] - $myColor[1]) + ($allColor[$i][2] - $myColor[2]) * ($allColor[$i][2] - $myColor[2]);
            if ($sum < $tempMin && $i != $color_1 && $i != $color_2) {
                $color_3 = $i;
                $tempMin = $sum;
            }
        }

        $result = array();
        array_push($result, $allColor[$color_1]);
        array_push($result, $allColor[$color_2]);
        array_push($result, $allColor[$color_3]);

        return $result;

    }

}

class first_template
{
    public $text_number;
    public $type;
    public $image_number;
    public $image_h = array();
    public $image_w = array();
}

class first_template_no_summary
{
    public $type;
    public $text_number;
    public $image_number;
    public $image_h = array();
    public $image_w = array();
}

class inner_template
{
    public $type;
    public $text_number;
    public $image_number;
    public $image_h = array();
    public $image_w = array();
}

class choose
{
    public $remainder;
    public $first_chosen;
    public $inner_flag;
    public $inner_chosen = array();
}

class ans
{
    public $chose;
    public $image_num;
    public $text_num;
    public $score = 100;
}



