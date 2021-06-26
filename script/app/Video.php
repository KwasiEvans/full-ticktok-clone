<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function favourite_to_user()
    {
    	return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function comments()
    {
    	return $this->HasMany('App\Comment');
    }
}
