<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManyToManyPolymorphic extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $videos = Video::all();
        $tags = Tag::all();

        // Attach random tags to each Post
        $posts->each(function ($post) use ($tags) {
            // This inserts rows into the 'taggables' table
            $post->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Attach random tags to each Video
        $videos->each(function ($video) use ($tags) {
            $video->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
