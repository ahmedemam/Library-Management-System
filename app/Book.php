<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'title',
        'description',
        'author',
        'image',
        'copiesNumber',
        'leaseFee',
        'rate',
    ];
    public function reviews()
    {
        return $this->hasMany('App\Review');
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
}