<?php

namespace DLArtist\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DLArtist\image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        //每天午夜时分清理一下redis的缓存，删除一些没用的图片
        $schedule->call($this->cleanImages())->daily();
        $schedule->call($this->cleanRedis())->daily();

        //检查现在的用户数是不是即将超出推荐的csv文件最大记录数，如果是就更新csv
        $schedule->call($this->addRecommendationListUserNum())->daily();

        //每10分钟更新一下推荐列表
        $schedule->call($this->updateRecommendationList())->everyTenMinutes();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected function cleanImages(){
        
        //定时一起清理本地无效文件
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

    protected function cleanRedis(){
        Cache::forget('articlesToAll');
        Cache::forget('max_article_id');
    }

    protected function updateRecommendationList(){
        $csv = array_map('str_getcsv', file(resource_path().'/recommendation/data/data.csv'));

        $max_user_id=DB::table('users')->max('id');

        //在Cache中查找修改过的用户信息，匹配到csv到对应列
        for($user_id=1; $user_id<=$max_user_id; $user_id++){
            for($cate=1; $cate<=6; $cate++){
                if(Cache::has('user:'.$user_id.':cate:'.$cate)){
                    $click_num=Cache::get('user:'.$user_id.':cate:'.$cate);
                    $thisRecord = (auth()->user()->id-1)*6+$cate;
                    $csv[$thisRecord]=$click_num;
                }
            }

        }

        //将修改过的csv文件写入
        $fp = fopen(resource_path().'/recommendation/data/data.csv', 'w');
        fputcsv($fp, array('UserID', 'KindID', 'Rating'));
        foreach($csv as $single_record){
            fputcsv($fp, $single_record);
        }
        fclose($fp);
    }

    protected function addRecommendationListUserNum(){

        $max_user_id=DB::table('users')->max('id');

        $csv = array_map('str_getcsv', file('data.csv'));

        if(sizeof($csv)-$max_user_id<500){
            $fp = fopen(resource_path().'/recommendation/data/data.csv', 'a');

            for($user_id=$max_user_id+1; $user_id<=1001+$max_user_id; $user_id++){
                for($kind_id=1; $kind_id<=6; $kind_id++){
                    $list = array($user_id, $kind_id, 0);
                    fputcsv($fp, $list);
                }
            }
            fclose($fp);
        }

    }





}
