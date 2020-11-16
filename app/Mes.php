<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    protected $table = 'meses';

    public function boletim(){
        return $this->hasMany('App\Boletim');
    }
}
