<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //


    public function Reviews()
    {
        return $this->hasMany('App\Review');
    }
}
