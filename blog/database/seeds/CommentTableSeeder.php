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
            'blog_id' => '1',
            'description' => 'Thông tin rõ ràng, tôi có thể hỗ trợ',
            'created_by' => 2,
            'updated_by' => 2
        ]);

        Comment::create([
            'blog_id' => '2',
            'description' => 'Xin thông tin về các phường sẽ hỗ trợ',
            'created_by' => 3,
            'updated_by' => 3
        ]);

        Comment::create([
            'blog_id' => '2',
            'description' => 'Phường Phú Thuận, Phú Mỹ, Tân Phú',
            'created_by' => 7,
            'updated_by' => 7
        ]);
    }
}
