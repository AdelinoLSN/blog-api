<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)
            ->create();

        $posts = collect();
        for ($i=0; $i<100; $i++) {
            $user = $users->random();

            $posts->push(Post::factory()->create(['user_id' => $user->id]));
        }
        
        for ($i=0; $i<200; $i++) {
            do {
                $post = $posts->random();
                $user = $users->random();
            } while ($post->user_id == $user->id);

            Comment::factory()->create(['post_id' => $post->id, 'user_id' => $user->id]);
        }
    }
}
