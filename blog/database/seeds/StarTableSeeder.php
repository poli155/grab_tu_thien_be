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
            'description' => 'Hỗ trợ ổn, nhà tài trợ tới đúng hẹn và trao tặng đúng số tiền đăng kí',
            'result' => 1,
            'attitude' => 2,
            'suggest' => 'Cần cải thiện cách ăn nói ở các lần từ thiện sau',
            'created_by' => 6,
            'updated_by' => 6,
        ]);

    }
}
