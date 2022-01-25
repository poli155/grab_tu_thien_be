<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(BlogTableSeeder::class);
        $this->call(BlogselectTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(StarTableSeeder::class);
        $this->call(PointTableSeeder::class);
    }
}
