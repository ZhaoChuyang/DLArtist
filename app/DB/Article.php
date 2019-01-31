<?php

namespace DLArtist\DB;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['user_id','content','title','vaild','click_num','update'];

    public function user(){
        return $this->belongsTo('DLArtist\User');
    }
}
