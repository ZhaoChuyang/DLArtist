<?php

namespace DLArtist\DB;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y/m/d H:i:s';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = ['user_id','content','title','time','vaild','click_num'];

    public function user(){
        return $this->belongsTo('DLArtist\User');
    }
}
