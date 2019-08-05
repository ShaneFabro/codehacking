<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    //
    protected $path = '/images/';

    use Sluggable;
    
    public function sluggable() {
        return [
            'slug' => [
                'source'         => 'title',
                'separator'      => '-',
                'includeTrashed' => true,
                'onUpdate'       => true
            ]
        ];
    }
        
    protected $fillable = [
        'user_id',
        'photo_id',
        'category_id', 
        'title', 
        'body'
    ];

    public function user() {

        return $this->belongsTo('App\User');

    }

    public function photo() {

        return $this->belongsTo('App\Photo');

    }

    public function category() {

        return $this->belongsTo('App\Category');

    }

    public function comments() {

        return $this->hasMany('App\Comment');

    }

    public function photoPlaceholder() {

        return "http://placehold.it/900x300";

    }
}
