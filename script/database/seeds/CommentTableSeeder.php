<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$video_first_comment_first = Comment::create([
        	'user_id' => 2,
        	'video_id' => 1,
        	'message' => 'Sad I missed seeing this live' 
        ]);

        Comment::create([
        	'user_id' => 5,
        	'video_id' => 1,
        	'parent_id' => $video_first_comment_first->id,
        	'message' => 'Loved catching up with you guys' 
        ]);

        $video_first_comment_second = Comment::create([
        	'user_id' => 3,
        	'video_id' => 1,
        	'message' => 'Thank you for this!' 
        ]);


        Comment::create([
        	'user_id' => 6,
        	'video_id' => 1,
        	'parent_id' => $video_first_comment_second->id,
        	'message' => 'Wow!' 
        ]);

        $video_first_comment_third = Comment::create([
        	'user_id' => 9,
        	'video_id' => 1,
        	'message' => 'Awesome! You are looking fine!' 
        ]);

        $video_first_comment_four = Comment::create([
        	'user_id' => 10,
        	'video_id' => 1,
        	'message' => 'Shei! Valo lagce!' 
        ]);
	        
    }
}
