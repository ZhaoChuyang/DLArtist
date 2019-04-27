<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;

class TypeSettingController extends Controller
{
    public function strip_html_tags($tags,$str){
        $html='/<'.$tags.'.*?><\/'.$tags.'>/';
        $data=preg_replace($html,'',$str);
        return $data;
    }
//    private static function cmp($a, $b) {
//        if ($a->text_number == $b->text_number) {
//            return 0;
//        }
//        return ($a->text_number < $b->text_number) ? -1 : 1;
//    }
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
            return $ans->chose;
        }
    }

    public function main(Request $request){

        $o_content=$request->input('content');
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


        $needSummary=$request->input('needSummary');
        $summary="";
        if($needSummary){
            $summary=$request->input('summary');
        }
        $title=$request->input('title');
        $author=$request->input('author');

        $ans=$this->typesetting($num, $img_num, $needSummary, $summary);
        $times=10;
        while($ans==""&&$times--)
            $ans=$this->typesetting($num, $img_num, $needSummary, $summary);
        return $ans;
    }
//$ans=typesetting();
//$times=10;
//while($ans==""&&$times--)$ans=typesetting();
//print_r($ans);
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



