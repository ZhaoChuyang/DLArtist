<?php

namespace DLArtist;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $table='Blog';

    protected $dateFormat='Y/m/d H:i';

    public function user(){
        return $this->belongsTo('App\User');
    }


}
