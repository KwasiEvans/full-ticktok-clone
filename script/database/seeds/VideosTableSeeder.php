<?php

use Illuminate\Database\Seeder;
use App\Video;
use Illuminate\Support\Str;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create([
        	'user_id' => 3,
        	'title' => "should I teach Lokie??",
        	'slug' => Str::slug('should I teach Lokie??'),
        	'url' => 'uploads/1.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 3,
        	'title' => "clearly my boyfriend is very supportive",
        	'slug' => Str::slug('clearly my boyfriend is very supportive'),
        	'url' => 'uploads/2.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 4,
        	'title' => "wait till the end",
        	'slug' => Str::slug('wait till the end'),
        	'url' => 'uploads/3.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "this filter knows what’s up",
        	'slug' => Str::slug('this filter knows what’s up'),
        	'url' => 'uploads/4.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "we just did a good thing",
        	'slug' => Str::slug('we just did a good thing'),
        	'url' => 'uploads/5.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "it all happened so fast",
        	'slug' => Str::slug('it all happened so fast'),
        	'url' => 'uploads/6.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "When we unite behind science & public health we save lives",
        	'slug' => Str::slug('When we unite behind science & public health we save lives'),
        	'url' => 'uploads/7.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "ALL midwives for their efforts to save lives of moms and babies.",
        	'slug' => Str::slug('ALL midwives for their efforts to save lives of moms and babies.'),
        	'url' => 'uploads/8.mp4',
            'country' => 'United States',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "How do Vaccines Work?",
        	'slug' => Str::slug('How do Vaccines Work?'),
        	'url' => 'uploads/5.mp4',
            'country' => 'United States',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "Join us in celebrating health workers today!",
        	'slug' => Str::slug('Join us in celebrating health workers today!'),
        	'url' => 'uploads/1.mp4',
            'country' => 'United States',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "What will you do at home?",
        	'slug' => Str::slug('What will you do at home?'),
        	'url' => 'uploads/3.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "I know a mf can hear me",
        	'slug' => Str::slug('I know a mf can hear me'),
        	'url' => 'uploads/7.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "she only got a tiny little bit of the crust !",
        	'slug' => Str::slug('she only got a tiny little bit of the crust !'),
        	'url' => 'uploads/6.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "buzz lightyear who ?????",
        	'slug' => Str::slug('buzz lightyear who ?????'),
        	'url' => 'uploads/4.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "I can put it in a bun",
        	'slug' => Str::slug('I can put it in a bun'),
        	'url' => 'uploads/8.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "vegan strawberry milk",
        	'slug' => Str::slug('vegan strawberry milk'),
        	'url' => 'uploads/1.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "quesadilla pocket",
        	'slug' => Str::slug('quesadilla pocket'),
        	'url' => 'uploads/2.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "in grade 7 a kid told me",
        	'slug' => Str::slug('in grade 7 a kid told me'),
        	'url' => 'uploads/3.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "whipped matcha",
        	'slug' => Str::slug('whipped matcha'),
        	'url' => 'uploads/5.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);

        Video::create([
        	'user_id' => 2,
        	'title' => "Cat Father: Volume IV",
        	'slug' => Str::slug('Cat Father: Volume IV'),
        	'url' => 'uploads/6.mp4',
            'country' => 'Bangladesh',
        	'status' => 'public'
        ]);
    }
}
