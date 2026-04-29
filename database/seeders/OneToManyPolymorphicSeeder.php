<?php

namespace Database\Seeders;

use App\Models\PolymorphicComment;
use Illuminate\Database\Seeder;

class OneToManyPolymorphicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create the Videos
        //$videos = Video::factory()->count(10)->create();

        // 2. Create Comments and attach them to EXISTING Posts
        //$existingPosts = Post::all();

        
        // PolymorphicComment::factory()
        //     ->count(20)
        //     ->hasAttached($existingPosts->random(3)) // Attaches each comment to 3 random posts
        //     ->hasAttached($videos->random(2))         // Attaches each comment to 2 random videos
        //     ->create();

        // 1. Create some videos first
        //Video::factory()->count(5)->create();

        // 2. Get your existing posts
        //$posts = Post::limit(10)->get();

        //3. Create comments specifically for your existing posts
        // $posts->each(function ($post) {
        //     Comment::factory()->count(3)->create([
        //         'commentable_id' => $post->id,
        //         'commentable_type' => Post::class,
        //     ]);
        // });

        // 4. Create some random comments (will mix between videos and posts)
        PolymorphicComment::factory()->count(10)->create();
    }
}
