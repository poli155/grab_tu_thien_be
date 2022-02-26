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
            'description' => 'Thông tin cần giúp đỡ chính xác',
            'created_by' => 2,
            'updated_by' => 2,
        ]);

    }
}
