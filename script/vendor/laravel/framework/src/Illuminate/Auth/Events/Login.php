<?php

namespace Illuminate\Auth\Events;

use Illuminate\Queue\SerializesModels;
use Auth;
use Session;

class Login
{
    use SerializesModels;

    /**
     * The authentication guard name.
     *
     * @var string
     */
    public $guard;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $user;

    /**
     * Indicates if the user should be "remembered".
     *
     * @var bool
     */
    public $remember;

    /**
     * Create a new event instance.
     *
     * @param  string  $guard
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  bool  $remember
     * @return void
     */
    public function __construct($guard, $user, $remember)
    {
        $this->user = $user;
        $this->guard = $guard;
        $this->remember = $remember;
        $user = Auth::User();
        if($user)
        {
            if($user->two_factor == null)
            {
                $user->two_factor = rand(2000,9000);
                $user->save(); 

                Session::put('two_factor',[
                    'id' => 'two'
                ]);
            }
        }
    }
}
