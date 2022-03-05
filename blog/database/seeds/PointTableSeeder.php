<?php

use Illuminate\Database\Seeder;
use App\Models\Point;

class PointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Point::truncate();

        Point::create([
            'blog_id' => 1,
            'target_id' => 6,
            'star' => 5,
            'result' => 1,
            'attitude' => 1,
            'suggest' => 'Với các đợt từ thiện sau, chủ bài viết cần trao nhà tài trợ danh sách các hộ dân',
            'description' => 'Thông tin cần giúp đỡ chính xác, chủ bài viết nhiệt tình',
            'created_by' => 2,
            'updated_by' => 2,
        ]);

    }
}
