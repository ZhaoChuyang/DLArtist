<?php

namespace DLArtist\DB;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $dateFormat = 'Y/m/d H:i';
    protected $fillable = ['user_id','content','title','time','vaild','click_num'];
}
