<?php

use Illuminate\Database\Seeder;
use App\Models\Blogselect;

class BlogselectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blogselect::truncate();

        Blogselect::create([
            'blog_id' => '1',
            'description' => 'Đồng ý hỗ trợ 100 triệu',
            'money' => 100,
            'status' => 1,
            'created_by' => 2,
            'updated_by' => 2
        ]);

        Blogselect::create([
            'blog_id' => '1',
            'description' => 'Đồng ý hỗ trợ 300 triệu',
            'money' => 300,
            'status' => 1,
            'created_by' => 3,
            'updated_by' => 3
        ]);

        Blogselect::create([
            'blog_id' => '1',
            'description' => 'Đồng ý hỗ trợ 100 triệu',
            'money' => 100,
            'created_by' => 4,
            'updated_by' => 4
        ]);

        Blogselect::create([
            'blog_id' => '1',
            'description' => 'Đồng ý hỗ trợ 300 triệu',
            'money' => 300,
            'created_by' => 5,
            'updated_by' => 5
        ]);

        Blogselect::create([
            'blog_id' => '2',
            'description' => 'Đồng ý hỗ trợ 200 triệu',
            'money' => 200,
            'created_by' => 3,
            'updated_by' => 3
        ]);
        
        Blogselect::create([
            'blog_id' => '2',
            'description' => 'Đồng ý hỗ trợ 300 triệu',
            'money' => 300,
            'created_by' => 4,
            'updated_by' => 4
        ]);
    }
}
