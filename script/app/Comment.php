<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function video()
    {
    	return $this->belongsTo('App\Video');
    }

    public function replies() {
	    return $this->hasMany('App\Comment', 'parent_id');
	}

	public function main_comment()
	{
		return $this->belongsTo('App\Comment', 'parent_id');
	}

	public function mention_user()
	{
		return $this->belongsTo('App\User', 'mention_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function favourite_to_user()
    {
    	return $this->belongsToMany('App\User')->withTimestamps();
    }
}
