<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function books()
    {
        return $this->hasMany('App\Book');
    }

    public function user()
    {
        return $this->belongsTo('App\Book');
    }
}