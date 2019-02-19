<?php

namespace DLArtist\DB;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    protected $table = 'reply';

    protected $primaryKey = 'pid';

    public $timestamps = false;

    protected $fillable = ['id','user_id','article_id','reply_name','content','vaild','update'];

    public function user(){
        return $this->belongsTo('DLArtist\User');
    }
}
