<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'role_id' => 1,
            'first_name' => 'Arafat',
        	'last_name' => 'Hossain',
        	'slug' => Str::slug('ArafatHossain'),
        	'email' => 'admin@gmail.com',
            'image' => 'uploads/profile1.png',
            'username' => '@arafathossain',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
        	'password' => Hash::make('rootadmin')
        ]);

        User::create([
        	'role_id' => 2,
            'first_name' => 'Tolis',
        	'last_name' => 'Ligkopoulos',
        	'slug' => Str::slug('TolisLigkopoulos'),
        	'email' => 'user@gmail.com',
            'country' => 'Bangladesh',
            'image' => 'uploads/profile2.png',
            'username' => '@tolisligkopoulos',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
        	'password' => Hash::make('rootuser')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Alison',
            'last_name' => 'Phood',
            'slug' => Str::slug('Alison Phood'),
            'email' => 'alison@gmail.com',
            'image' => 'uploads/profile3.png',
            'username' => '@alisonphood',
            'country' => 'United States',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootalison')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Ankhi',
            'last_name' => 'Alamgir',
            'slug' => Str::slug('Ankhi Alamgir'),
            'email' => 'ankhi@gmail.com',
            'image' => 'uploads/profile4.png',
            'username' => '@ankhialamgir',
             'country' => 'United States',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootankhi')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Somprity',
            'last_name' => 'Chowdhury',
            'slug' => Str::slug('Somprity Chowdhury'),
            'email' => 'somprity@gmail.com',
            'image' => 'uploads/profile5.png',
            'username' => '@sompritychowdhury',
             'country' => 'United States',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootsomprity')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Neelanjona',
            'last_name' => 'Neela',
            'slug' => Str::slug('Neelanjona Neela'),
            'email' => 'neelanjona@gmail.com',
            'image' => 'uploads/profile6.png',
            'username' => '@neelanjonaneela',
             'country' => 'United States',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootneelanjona')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Srabanti',
            'last_name' => 'Smile',
            'slug' => Str::slug('Srabanti Smile'),
            'email' => 'srabanti@gmail.com',
            'image' => 'uploads/profile7.png',
            'username' => '@srabantismile',
             'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootsrabanti')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Tahsankhan',
            'last_name' => 'Ahamed',
            'slug' => Str::slug('Tahsankhan Ahamed'),
            'email' => 'tahsankhan@gmail.com',
            'image' => 'uploads/profile8.png',
            'username' => '@tahsankhanahamed',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('roottahsankhan')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Premraj',
            'last_name' => 'Man',
            'slug' => Str::slug('Premraj Man'),
            'email' => 'premraj@gmail.com',
            'image' => 'uploads/profile9.png',
            'username' => '@premrajman',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootpremraj')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Creative',
            'last_name' => 'It',
            'slug' => Str::slug('Creative It'),
            'email' => 'creative@gmail.com',
            'image' => 'uploads/profile10.png',
            'username' => '@creativeit',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootcreative')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Tamim',
            'last_name' => 'Hossain',
            'slug' => Str::slug('Tamim Hossain'),
            'email' => 'tamim@gmail.com',
            'image' => 'uploads/profile11.png',
            'username' => '@tamimhossain',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('roottamim')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Nawsheen',
            'last_name' => 'Nahreen',
            'slug' => Str::slug('Nawsheen Nahreen'),
            'email' => 'nawsheen@gmail.com',
            'image' => 'uploads/profile12.png',
            'username' => '@nawsheennahreen',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootnawsheen')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Peya',
            'last_name' => 'Jannatul',
            'slug' => Str::slug('Peya Jannatul'),
            'email' => 'peya@gmail.com',
            'image' => 'uploads/profile13.png',
            'username' => '@peyajannatul',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootpeya')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Urva',
            'last_name' => 'Shirautela',
            'slug' => Str::slug('Urva Shirautela'),
            'email' => 'urva@gmail.com',
            'image' => 'uploads/profile14.png',
            'username' => '@urvashirautela',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rooturva')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Sabnam',
            'last_name' => 'Faria',
            'slug' => Str::slug('Sabnam Faria'),
            'email' => 'sabnam@gmail.com',
            'image' => 'uploads/profile15.png',
            'username' => '@Sabnamfaria',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootsabnam')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Safyan',
            'last_name' => 'Sary',
            'slug' => Str::slug('Safyan Sary'),
            'email' => 'safyan@gmail.com',
            'image' => 'uploads/profile16.png',
            'username' => '@safyansary',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootsafyan')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Bhabna',
            'last_name' => 'Ashna',
            'slug' => Str::slug('Bhabna Ashna'),
            'email' => 'bhabna@gmail.com',
            'image' => 'uploads/profile17.png',
            'username' => '@bhabnaashna',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootbhabna')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Hamid',
            'last_name' => 'Mousumi',
            'slug' => Str::slug('Hamid Mousumi'),
            'email' => 'hamid@gmail.com',
            'image' => 'uploads/profile18.png',
            'username' => '@hamidmousumi',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('roothamid')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Roberto',
            'last_name' => 'Dev',
            'slug' => Str::slug('Roberto Dev'),
            'email' => 'roberto@gmail.com',
            'image' => 'uploads/profile19.png',
            'username' => '@robertodev',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootroberto')
        ]);

        User::create([
            'role_id' => 2,
            'first_name' => 'Jaya',
            'last_name' => 'Ahsan',
            'slug' => Str::slug('Jaya Ahsan'),
            'email' => 'jaya@gmail.com',
            'image' => 'uploads/profile20.png',
            'username' => '@jayaahsan',
            'country' => 'Bangladesh',
            "value" => '{"bio":"Professional dancer-instructor-trainer!!!","total_view":0,"total_like":0,"city":null,"country":null,"gender":"male","age":22,"status":"active","verified":"unverified","facebook":null,"twitter":null,"instagram":null,"pinterest":null,"relation":"single","cover":"uploads/cover.jpg","two_step":"disable","wallet":"0"}',
            'password' => Hash::make('rootjaya')
        ]);
    }
}
