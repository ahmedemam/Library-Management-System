<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Book extends Model
{
     use Searchable;
    use SoftDeletes;
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'description',
        'author',
        'image',
        'copiesNumber',
        'leaseFee'
    ];
    public function reviews()
    {
        return $this->hasMany('App\Comment');
    }
    public function favourite()
    {
        return $this->belongsTo('App\Favourite');
    }


    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

      public function searchableAs()
    {
        return 'title';
    }
  
    public function getScoutKey()
    {
        return $this->title;
    }
}