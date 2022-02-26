<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'status' => 1,
            'phone' => '0900999000',
            'location_id' => '3',
            'birthday' => '1999-05-15',
            'role_id' => '1',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'helper1@gmail.com',
            'name' => 'helper1',
            'status' => 1,
            'phone' => '0900999001',
            'location_id' => '1',
            'birthday' => '1999-05-16',
            'role_id' => '2',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'helper2@gmail.com',
            'name' => 'helper2',
            'status' => 1,
            'phone' => '0900999002',
            'location_id' => '2',
            'birthday' => '1999-05-17',
            'role_id' => '2',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'helper3@gmail.com',
            'name' => 'helper3',
            'status' => 1,
            'phone' => '0900999003',
            'location_id' => '3',
            'birthday' => '1999-05-18',
            'role_id' => '2',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'helper4@gmail.com',
            'name' => 'helper4',
            'status' => 1,
            'phone' => '0900999004',
            'location_id' => '4',
            'birthday' => '1999-05-19',
            'role_id' => '2',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'customer1@gmail.com',
            'name' => 'customer1',
            'status' => 1,
            'phone' => '0900999991',
            'location_id' => '1',
            'birthday' => '1999-05-15',
            'role_id' => '3',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'customer2@gmail.com',
            'name' => 'customer2',
            'status' => 1,
            'phone' => '0900999992',
            'location_id' => '2',
            'birthday' => '1999-05-16',
            'role_id' => '3',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'customer3@gmail.com',
            'name' => 'customer3',
            'status' => 1,
            'phone' => '0900999993',
            'location_id' => '3',
            'birthday' => '1999-05-17',
            'role_id' => '3',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'customer4@gmail.com',
            'name' => 'customer4',
            'status' => 1,
            'phone' => '0900999994',
            'location_id' => '4',
            'birthday' => '1999-05-18',
            'role_id' => '3',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'customer5@gmail.com',
            'name' => 'customer5',
            'status' => 1,
            'phone' => '0900999995',
            'location_id' => '5',
            'birthday' => '1999-05-19',
            'role_id' => '3',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'customer6@gmail.com',
            'name' => 'customer6',
            'status' => 1,
            'phone' => '0900999996',
            'location_id' => '6',
            'birthday' => '1999-05-20',
            'role_id' => '3',
            'created_by' => 1,
            'updated_by' => 1
        ]);
        User::create([
            'password' => Hash::make('111111'),
            'email' => 'customer7@gmail.com',
            'name' => 'customer7',
            'status' => 1,
            'phone' => '0900999997',
            'location_id' => '7',
            'birthday' => '1999-05-21',
            'role_id' => '3',
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
