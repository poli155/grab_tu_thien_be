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
            'blog_id' => 1,
            'target_id' => 2,
            'star' => 5,
            'description' => 'Hỗ trợ tuyệt vời',
            'created_by' => 6,
            'updated_by' => 6,
        ]);

    }
}
