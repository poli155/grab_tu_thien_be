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
            'title' => 'Hỗ trợ sau bão số 1 tại Hà Nội',
            'description' => 'Cần hỗ trợ 500 triệu cho đồng bào quận Đống Đa, Hà Nội sau bão',
            'location_id' => 1,
            'target' => 500,
            'receive' => 400,
            'date' => '2021-11-05',
            'created_by' => 6,
            'updated_by' => 6
        ]);
        
        Blog::create([
            'title' => 'Hỗ trợ sau bão số 2 tại TP.HCM',
            'description' => 'Cần hỗ trợ 500 triệu cho 500 hộ dân quận 7, TP.HCM sau bão số 2',
            'location_id' => 2,
            'target' => 500,
            'date' => '2022-05-30',
            'created_by' => 7,
            'updated_by' => 7
        ]);

        Blog::create([
            'title' => 'Hỗ trợ sau bão số 3 tại Đà Nẵng',
            'description' => 'Cần hỗ trợ 300 triệu cho 300 hộ dân Sơn Trà, Đà nẵng sau bão số 3',
            'location_id' => 3,
            'target' => 300,
            'date' => '2022-07-15',
            'created_by' => 8,
            'updated_by' => 8
        ]);

        Blog::create([
            'title' => 'Hỗ trợ quà tết thiếu nhi Hải Phòng',
            'description' => 'Cần hỗ trợ 1000 suất quà cho bệnh viện nhi của tỉnh nhân dịp tết thiếu nhi ',
            'location_id' => 4,
            'target' => 100,
            'date' => '2022-05-31',
            'created_by' => 9,
            'updated_by' => 9
        ]);

        Blog::create([
            'title' => 'Hỗ trợ quà tết thiếu nhi Cần Thơ',
            'description' => 'Cần hỗ trợ 500 suất quà cho bệnh viện nhi của tỉnh nhân dịp tết thiếu nhi ',
            'location_id' => 5,
            'target' => 50,
            'date' => '2022-05-31',
            'created_by' => 10,
            'updated_by' => 10
        ]);

        Blog::create([
            'title' => 'Hỗ trợ quà tết thiếu nhi An Giang',
            'description' => 'Cần hỗ trợ 300 suất quà cho bệnh viện nhi của tỉnh nhân dịp tết thiếu nhi ',
            'location_id' => 6,
            'target' => 30,
            'date' => '2022-05-31',
            'created_by' => 11,
            'updated_by' => 11
        ]);
    }
}
