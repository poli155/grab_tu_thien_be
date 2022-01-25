<?php

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::truncate();

        Blog::create([
            'title' => 'Lũ miền Trung tháng 10',
            'description' => 'Cần hỗ trợ 500 triệu cho đồng bào quận Sơn Trà, Đà Nẵng sau lũ',
            'location_id' => 3,
            'date' => '2021-11-05',
            'created_by' => 5,
            'updated_by' => 5
        ]);
        
        Blog::create([
            'title' => 'Hỗ trợ sau bão số 2',
            'description' => 'Cần hỗ trợ 200 triệu cho 200 hộ dân Đà Nẵng sau bão số 2',
            'location_id' => 3,
            'date' => '2022-05-31',
            'created_by' => 5,
            'updated_by' => 5
        ]);

        Blog::create([
            'title' => 'Trung thu cho trẻ em tại trại mồ côi ABC',
            'description' => 'Cần hỗ trợ 1000 suất bánh Trung thu cho trẻ em tại trại mồ côi ABC, đường 123',
            'location_id' => 2,
            'date' => '2021-11-05',
            'created_by' => 4,
            'updated_by' => 4
        ]);
    }
}
