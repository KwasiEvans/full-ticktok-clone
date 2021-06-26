<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Option;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }else{  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }  

        $address = geoip()->getLocation($ip);

        $option = Option::where('key','user_value')->first();
        $user_value = json_decode($option->value);
        if($user_value->user_verification == 'enabled')
        {
            $status = 'deactive';
        }else{
            $status = 'active';
        }

        return User::create([
            'role_id' => 2,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'slug' => Str::slug($data['first_name'].$data['last_name']),
            'email' => $data['email'],
            'username' => '@'.Str::slug($data['username']),
            'country' => $address->country,
            'password' => Hash::make($data['password']),
            'value' => '{"bio":null,"total_view":0,"total_like":0,"city":"'.$address['city'].'","country":"'.$address['country'].'","gender":null,"age":null,"status":"'.$status.'","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":null,"cover":"uploads/cover.png","two_step":"disable","wallet":"0"}',
        ]);
    }
}
