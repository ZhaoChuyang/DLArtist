<?php

namespace DLArtist\DB;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','username','article','time','vaild','click'];
}
