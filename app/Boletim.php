<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boletim extends Model
{
    use SoftDeletes;
    protected $table = 'boletins';

    function mes(){
        return $this->belongsTo('App\Mes');
    }
}
