<?php

use Illuminate\Database\Seeder;
use App\Option;
use App\Language;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::create([
        	'key' => 'settings',
        	'value' => '{"logo":"uploads/logo.png","copyright":"© COPYRIGHT 2020 BY TONGTANG"}'
        ]);

        Option::create([
            'key' => 'followers',
            'value' => 1000
        ]);

        Option::create([
            'key' => 'total_view',
            'value' => 10000
        ]);

        Option::create([
            'key' => 'per_link',
            'value' => .5
        ]);

        Option::create([
            'key' => 'author_get_per_link',
            'value' => .05
        ]);

        Option::create([
            'key' => 'per_impression',
            'value' => .1
        ]);

        Option::create([
            'key' => 'author_get_per_impression',
            'value' => .01
        ]);

        Option::create([
            'key' => 'ads_show_per_second',
            'value' => 60
        ]);

        Option::create([
            'key' => 'user_value',
            'value' => '{"user_registation":"enabled","email_verification":"disabled","delete_account":"enabled","user_monetization":"enabled","user_payment_withdraw":"enabled","user_verification":"disabled"}'
        ]);

        Option::create([
            'key' => 'site_value',
            'value' => '{"site_title":"TongTang - Laravel short video based premium script","site_name":"TongTang","site_email":"admin@gmail.com","site_description":null,"facebook_url":null,"twitter_url":null,"google_url":null,"dark_logo":"frontend/img/logo/logo.png","light_logo":"frontend/img/logo/white_logo.png","default_language":"en","active_lang":"English","favicon":"frontend/img/favicon.ico"}'
        ]);

        Language::create([
            'name' => 'English',
            'code' => 'en',
            'status' => 'active'
        ]);

        Option::create([
            'key' => 'currency',
            'value' => '{"code":"USD","symbol":"$"}'
        ]);
    }
}
