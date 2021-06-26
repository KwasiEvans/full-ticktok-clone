<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelFollow\Followable;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Option;

class User extends Authenticatable implements MustVerifyEmail
{
    use Followable;

    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','first_name','last_name','slug','country','value','username','email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function favourite_videos()
    {
        return $this->belongsToMany('App\Video')->withTimestamps();
    }
    
    public function favourite_comments()
    {
        return $this->belongsToMany('App\Comment')->withTimestamps();
    }

    public function block_users()
    {
        return $this->belongsToMany('App\User','block_user','user_id','block_id');
    }

    public function sendEmailVerificationNotification()
    {
        $option = Option::where('key','user_value')->first();
        $user_value = json_decode($option->value);
        if($user_value->email_verification == 'enabled')
        {
            $this->notify(new VerifyEmail);
        }
    }
}
