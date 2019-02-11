<?php

namespace DLArtist\DB;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['user_id','content','vaild','update'];

    public function user(){
        return $this->belongsTo('DLArtist\User');
    }
}
