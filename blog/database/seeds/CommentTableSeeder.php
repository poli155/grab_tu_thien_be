<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();

        Comment::create([
            'blog_id' => '2',
            'description' => 'Tôi có thể hỗ trợ 100 triệu',
            'created_by' => 2,
            'updated_by' => 2
        ]);

        Comment::create([
            'blog_id' => '2',
            'description' => 'Tôi có thể hỗ trợ 100 triệu',
            'created_by' => 3,
            'updated_by' => 3
        ]);
    }
}
