<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //

    public function Book()
    {
        return $this->belongsTo('App\Book');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
