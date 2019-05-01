<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use SoapClient;

class TypeSettingController extends Controller
{
    public function strip_html_tags($tags,$str){
        $html='/<'.$tags.'.*?><\/'.$tags.'>/';
        $data=preg_replace($html,'',$str);
        return $data;
    }

    public function re_duplicate($a){
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
            return 1612*2;
        }
        else if($model==2){
            return 1472*2;
        }
        else if($model==3){
            return 1389*2;
        }
        else if($model==4){
            return 1140*2;
        }
        else if($model==5){
            return 1548*2;
        }
        else if($model==6){
            return 2392*2;
        }
        else if($model==7){
            return 2508*2;
        }
        return 0;
    }
    function cal_image_num($model){
        if($model==1||$model==7){
            return 2;
        }
        else if($model==5){
            return 6;
        }
        else return 1;
    }
    function re_cmp_text($a, $b) {
        if ($a->text_num == $b->text_num) {
            return 0;
        }
        return ($a->text_num < $b->text_num) ? -1 : 1;
    }
    function return_last_page($template,$n){
        while($template>=$n){
            $template=(int)($template/$n);
        }
        return $template;
    }
    public function return_unique_page($template,$n){
        $temp=array();
        while($template){
            $save=$template%$n;
            $template=(int)($template/$n);
            array_push($temp,$save);
        }
        return count(array_unique($temp));
    }
    public function return_max_score($a,$b){
        if ($a->score == $b->score) {
            return ($a->chose>$b->chose) ? 1 : -1;
        }
        return ($a->score < $b->score) ? 1 : -1;
    }
    public function encoder($final_answer,$n){
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
    public function penalty($recommend,$last,$text_num,$img_num,$n){
        //text_num
        $token=$text_num;
        for($i=0;$i<sizeof($recommend);$i++){
            $recommend[$i]->score-=(int)(($recommend[$i]->text_num-$token)/200);
        }
        //image_number
        for($i=0;$i<sizeof($recommend);$i++){
            $r=$recommend[$i]->image_num-$img_num;
            if($r>=0){
                $recommend[$i]->score-=$r*5;
            }
            else{
                $recommend[$i]->score-=999;
            }
        }
        for($i=0;$i<sizeof($recommend);$i++){
            if( $recommend[$i]->score < 0){
                array_splice($recommend, $i, 1);
                $i--;
            }
        }
        //last_text
        for($i=0;$i<sizeof($recommend);$i++){
            $type=$this->return_last_page($recommend[$i]->chose,$n);
            if(!in_array($type, $last)){
                array_splice($recommend, $i, 1);
                $i--;
            }
        }
        //template_multiple
        for($i=0;$i<sizeof($recommend);$i++){
            $mul=$this->return_unique_page($recommend[$i]->chose,$n);
            $recommend[$i]->score+=$mul*4;
        }
        usort( $recommend, function($a,$b){
            if ($a->score == $b->score) {
                return ($a->chose>$b->chose) ? 1 : -1;
            }
            return ($a->score < $b->score) ? 1 : -1;
        });
        return $recommend;
    }
    public function convert_dlartist($recommend,$n){
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

    public function  typesetting($word_count, $imgNum, $hasSummary, $summary="")
    {
        $n = 10;

        $model_1 = new first_template();
        $model_1->text_number = 1612 * 2;
        $model_1->type = 1;
        $model_1->image_number = 2;
        $model_1->image_h[0] = 32.3;
        $model_1->image_h[1] = 135.5;
        $model_1->image_w[0] = 23;
        $model_1->image_w[1] = 94;

        $model_2 = new first_template();
        $model_2->text_number = 1472 * 2;
        $model_2->type = 2;
        $model_2->image_number = 1;
        $model_2->image_h[0] = 141.5;
        $model_2->image_w[0] = 98;

        $model_3 = new first_template();
        $model_3->text_number = 1389 * 2;
        $model_3->type = 3;
        $model_3->image_number = 1;
        $model_3->image_h[0] = 144.7;
        $model_3->image_w[0] = 122.15;

        $model_4 = new first_template_no_summary();
        $model_4->text_number = 1140 * 2;
        $model_4->type = 4;
        $model_4->image_number = 1;
        $model_4->image_h[0] = 294.8;
        $model_4->image_w[0] = 109.5;

        $model_5 = new first_template_no_summary();
        $model_5->text_number = 1548 * 2;
        $model_5->type = 5;
        $model_5->image_number = 6;
        $model_5->image_h[0] = 45;
        $model_5->image_w[0] = 45;
        $model_5->image_h[1] = 60;
        $model_5->image_w[1] = 60;
        $model_5->image_h[2] = 60;
        $model_5->image_w[2] = 60;
        $model_5->image_h[3] = 60;
        $model_5->image_w[3] = 60;
        $model_5->image_h[4] = 60;
        $model_5->image_w[4] = 60;
        $model_5->image_h[5] = 60;
        $model_5->image_w[5] = 60;
//---------------------------------------------------------
        $model_6 = new inner_template();
        $model_6->text_number = 2392 * 2;
        $model_6->type = 6;
        $model_6->image_number = 1;
        $model_6->image_h[0] = 131.5;
        $model_6->image_w[0] = 93;
//---------------------------------------------------------
        $model_7 = new inner_template();
        $model_7->text_number = 2508 * 2;
        $model_7->type = 7;
        $model_7->image_number = 2;
        $model_7->image_h[0] = 94.3;
        $model_7->image_w[0] = 88;
        $model_7->image_h[1] = 105.5;
        $model_7->image_w[1] = 94.1;
//-----------------------------------------------------------------------------------------------------------------------
        $text_num = $word_count;
        $img_num = $imgNum;
        $flag = $hasSummary;

        $template = array();
        array_push($template, $model_1, $model_2, $model_3, $model_4, $model_5, $model_6, $model_7);
        $first_and_summary = array();
        array_push($first_and_summary, $model_1, $model_2, $model_3);
        $first_and_no_summary = array();
        array_push($first_and_no_summary, $model_4, $model_5);
        $inner = array();
        array_push($inner, $model_6, $model_7);
        $last = array();
        array_push($last,$model_1->type,$model_2->type,$model_3->type,$model_4->type,$model_5->type,$model_7->type);

        $remainder_text = $text_num;
        $temp_chose = array();
        //first page
        if ($flag) {
            uasort($first_and_summary, function($a, $b) {
                if ($a->text_number == $b->text_number) {
                    return 0;
                }
                return ($a->text_number < $b->text_number) ? -1 : 1;
            });
            foreach ($first_and_summary as $tplt) {
                if ($remainder_text >= $tplt->text_number * 0.85) {
                    $chose = new choose();
                    $chose->remainder = $remainder_text - $tplt->text_number;
                    $chose->first_chosen = $tplt->type;
                    if ($chose->remainder <= 0) $chose->inner_flag=0;
                    else $chose->inner_flag=1;
                    array_push($temp_chose, $chose);
                }
                else break;
            }
            if (sizeof($temp_chose) == 0) {
                return 0;
            }//the text are too few
        }
        else {
            uasort($first_and_no_summary, function($a, $b) {
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
                    if ($chose->remainder <= 0) $chose->inner_flag=0;
                    else $chose->inner_flag=1;
                    array_push($temp_chose, $chose);
                }
                else break;
            }
            if (sizeof($temp_chose) == 0) {
                return 0;
            }//the text are too few
        }
        //
        //inner page
        foreach ($temp_chose as $temp) {
            if ($temp->inner_flag) {
                $times = 20;
                $recover = $temp->remainder;
                for ($i = 0; $i < max(sizeof($inner),$times--); $i++) {
                    $tag = true;
                    while ($temp->remainder > 0) {
                        $index = rand(0, sizeof($inner) - 1);
                        if ($tag) {
                            $temp->inner_chosen[19 - $times] = $inner[$index]->type;
                            $tag = false;
                        } else {
                            $temp->inner_chosen[19 - $times] *= $n;
                            $temp->inner_chosen[19 - $times] += $inner[$index]->type;
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
        $Hybridization =(int)($text_num/3000)+1;
        $ans = new ans();
        $ans->score = 0;
        $result=array();
        while ($Hybridization--) {
            for ($k = 0; $k < sizeof($temp_chose); $k++) {
                for ($i = 0; $i < sizeof($temp_chose); $i++) {
                    for ($j = 0; $j < sizeof($temp_chose[$i]->inner_chosen); $j++) {
                        if(sizeof($temp_chose[$k]->inner_chosen)==0){
                            array_push($final_answer, $temp_chose[$k]->first_chosen);
                        }
                        else {
                            array_push($final_answer, $temp_chose[$i]->inner_chosen[$j] * $n + $temp_chose[$k]->first_chosen);
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
        for($i=0;$i<sizeof($recommend);$i++){
            array_push($result,$recommend[$i]);
        }
        for($i=0;$i<sizeof($result);$i++) {
            if (sizeof($result) && $ans->score < $result[$i]->score) $ans = $result[$i];
        }
        if ($ans->score){
            $image=array();
            $ch=$ans->chose;

            while($ch){
                $q=$ch%$n;
                $ch=(int)($ch/$n);
                if($q==1){
                    for($i=0;$i<$model_1->image_number;$i++){
                        $image_cell=[];
                        array_push($image_cell, $model_1->image_h[$i]);
                        array_push($image_cell, $model_1->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if($q==2){
                    for($i=0;$i<$model_2->image_number;$i++){
                        $image_cell=[];
                        array_push($image_cell,$model_2->image_h[$i]);
                        array_push($image_cell,$model_2->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if($q==3){
                    for($i=0;$i<$model_3->image_number;$i++){
                        $image_cell=[];
                        array_push($image_cell, $model_3->image_h[$i]);
                        array_push($image_cell, $model_3->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if($q==4){
                    for($i=0;$i<$model_4->image_number;$i++){
                        $image_cell=[];
                        array_push($image_cell, $model_4->image_h[$i]);
                        array_push($image_cell, $model_4->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if($q==5){
                    for($i=0;$i<$model_5->image_number;$i++){
                        $image_cell=[];
                        array_push($image_cell, $model_5->image_h[$i]);
                        array_push($image_cell, $model_5->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if($q==6){
                    for($i=0;$i<$model_6->image_number;$i++){
                        $image_cell=[];
                        array_push($image_cell, $model_6->image_h[$i]);
                        array_push($image_cell, $model_6->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
                if($q==7){
                    for($i=0;$i<$model_7->image_number;$i++){
                        $image_cell=[];
                        array_push($image_cell, $model_7->image_h[$i]);
                        array_push($image_cell, $model_7->image_w[$i]);
                        array_push($image, $image_cell);
                    }
                }
            }
            return array('chose'=>$ans->chose,"image"=>$image);
        }
    }

    public function main(Request $request){

        $validator = Validator::make($request->all(), [
            'article_id'=>'required|not_in:0',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->add('status', 0);
        }


        $article_id=$request->input('article_id');
        $user_id=auth()->user()->id;

        $article=null;

        if(Cache::has('article:'.$article_id)){
            $article=Cache::get('article:'.$article_id);
        }
        else{
            $article=DB::table('articles')->find($article_id);
            Cache::put('article:'.$article_id, $article, 720);
        }

        $content_path=$article->content;

        $o_content=Storage::disk('ftp')->get('content/'.$content_path);

        //$o_content=$request->input('content');
        preg_match_all('/<img[^>]*?src="([^"]*?)"[^>]*?>/i', $o_content, $img);
        $img_num = sizeof($img[1]);

        $content=htmlspecialchars_decode($o_content);
        $content=str_replace("&#39;", "'", $content);
        $content = strip_tags($content, '<p>');
        $content=$this->strip_html_tags("p",$content);
        $content=str_replace("\n", "", $content);
        $content=str_replace("</p>", "\n", $content);
        $content = strip_tags($content, '');
        $num=mb_strwidth($content, 'utf8')*1.2;

        $needSummary=$article->needSummary;

        $summary="";

        if($needSummary){
            $summary=$article->summary;
        }
        $title=$article->title;
        $author=$article->author;
        $ans=$this->typesetting($num, $img_num, $needSummary, $summary);
        $times=10;
        while($ans==""&&$times--)
            $ans=$this->typesetting($num, $img_num, $needSummary, $summary);

        return response()->json(['ans'=>$ans, 'image_path'=>$img]);
    }

    public function connectInDesign(Request $request){

        $validator = Validator:: make($request->all(), [
            'images'=>'required',
            'article_id'=>'required|not_in:0',
            'chose'=>'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->add('status', 0);
        }


        $article_id=$request->input('article_id');

        $article=null;

        if(Cache::has('article:'.$article_id)){
            $article=Cache::get('article:'.$article_id);
        }else{
            $article=DB::table('articles')->find($article_id);
            Cache::put('article:'.$article_id, $article, 1440);
        }

        //待传参数
        $doDebug=false;
        $chose=$request->input('chose');
        $author=$article->author;
        $summary=$article->summary;
        $title=$article->title;
        $content='/C/Users/Administrator/Desktop/ftp/content/'.$article->content;

        $images=$request->input('images');
        $image_num=sizeof($images);
        $R=255;
        $G=0;
        $B=0;
        $imageString="";


        foreach($images as $img){
            $imageString=$imageString."q/C/Users/Administrator/Desktop/ftp/image/processed/".$img;
        }

        //服务器地址
        $myHost = 'http://101.76.253.145:12345';
        //wsdl地址
        $myWSDL = "$myHost/Service?wsdl";
        //script地址
        $myScriptFile = resource_path().'/js/newspaperTemplate.js';
        //脚本语言
        $myScriptLanguage = "javascript";
        //脚本内容
        $myScriptText='';

        //传参
        $myScriptArgs=array();
        $myScriptArgs[0]=array('name'=>'chose', 'value'=>$chose);
        $myScriptArgs[1]=array('name'=>'get_image_num', 'value'=>$image_num);
        $myScriptArgs[2]=array('name'=>'get_pic', 'value'=>$imageString);
        $myScriptArgs[3]=array('name'=>'R', 'value'=>$R);
        $myScriptArgs[4]=array('name'=>'G', 'value'=>$G);
        $myScriptArgs[5]=array('name'=>'B', 'value'=>$B);
        $myScriptArgs[6]=array('name'=>'text_title', 'value'=>$title);
        $myScriptArgs[7]=array('name'=>'text_author', 'value'=>$author);
        $myScriptArgs[8]=array('name'=>'text_content', 'value'=>$content);
        $myScriptArgs[9]=array('name'=>'text_summary', 'value'=>$summary);

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

        try
        {
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
            $scriptParams = array(	'scriptText' 		=> $scriptText,
                'scriptLanguage' 	=> $scriptLanguage,
                'scriptFile'		=> $scriptFile,
                'scriptArgs'		=> $scriptArgs);
            $runScriptParams = array ('runScriptParameters' => $scriptParams);

            $result = $client->RunScript($runScriptParams);

            // DISPLAY RESULTS
            if ($printDebugInfo) {
                print_r($result);
            }

            // RELEASE the client
            unset($client);

        }
        catch (SoapFault $exception)
        {
            if ($printDebugInfo) {
                print_r($exception);
            }
            $result = $exception;
        }

        return $result;
    }

}

class first_template{
    public $text_number;
    public $type;
    public $image_number;
    public $image_h = array();
    public $image_w = array();
}
class first_template_no_summary{
    public $type;
    public $text_number;
    public $image_number;
    public $image_h = array();
    public $image_w = array();
}
class inner_template{
    public $type;
    public $text_number;
    public $image_number;
    public $image_h = array();
    public $image_w = array();
}
class choose{
    public $remainder;
    public $first_chosen;
    public $inner_flag;
    public $inner_chosen=array();
}
class ans{
    public $chose;
    public $image_num;
    public $text_num;
    public $score=100;
}



