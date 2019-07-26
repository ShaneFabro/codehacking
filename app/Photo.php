<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = ['file'];

    protected $uploads = '/images/';

    public function getFileAttribute($attribute) {

        return $this->uploads . $attribute;

    }

    public function user() {

        return $this->hasOne('App\User');

    }

    public function post() {

        return $this->hasOne('App\Post');

    }
}
