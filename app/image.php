<?php

namespace DLArtist;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class image extends Model
{
    //
    protected $table='images';
    protected $primaryKey='id';
    protected $dateFormat='Y/m/d H:i:s';

    public function user(){
        return $this->belongsTo('DLArtist\User');
    }
}

class FileUpload extends Model
{
    use SoftDeletes;
    protected $table = 'fileUploads';
    protected $fillable = [
        'title',
        'path'
    ];
    protected $dates = [
        'deleted_at'
    ];
}
