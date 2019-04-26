<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeasedBooks extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function books(){
        return $this->hasMany('App\Book');
    }
}