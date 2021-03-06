<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create(['role_name' => 'Admin']);
        Role::create(['role_name' => 'Helper']);
        Role::create(['role_name' => 'Customer']);
    }
}
