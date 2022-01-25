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
            'blog_id' => '2',
            'description' => 'Đồng ý hỗ trợ 1 phần 100 triệu',
            'created_by' => 2,
            'updated_by' => 2
        ]);

        Blogselect::create([
            'blog_id' => '2',
            'description' => 'Đồng ý hỗ trợ 1 phần 100 triệu',
            'created_by' => 3,
            'updated_by' => 3
        ]);
    }
}
