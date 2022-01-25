<?php

use Illuminate\Database\Seeder;
use App\Models\Star;

class StarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Star::truncate();

        Star::create([
            'blog_id' => 2,
            'target_id' => 2,
            'star' => 5,
            'description' => 'Hỗ trợ tuyệt vời',
            'created_by' => 5,
            'updated_by' => 5,
        ]);

        Star::create([
            'blog_id' => 2,
            'target_id' => 3,
            'star' => 3.5,
            'description' => 'Chậm so với kế hoạch',
            'created_by' => 5,
            'updated_by' => 5,
        ]);
    }
}
