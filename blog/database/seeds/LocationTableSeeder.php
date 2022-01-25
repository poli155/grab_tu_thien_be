<?php

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::truncate();

        Location::create(['location_name' => 'Tp.Hà Nội']);
        Location::create(['location_name' => 'Tp.Hồ Chí Minh']);
        Location::create(['location_name' => 'Tp.Đà Nẵng']);
        Location::create(['location_name' => 'Tp.Hải Phòng']);
        Location::create(['location_name' => 'Tp.Cần Thơ']);
        Location::create(['location_name' => 'An Giang']);
        Location::create(['location_name' => 'Bà Rịa - Vũng Tàu']);
        Location::create(['location_name' => 'Bắc Giang']);
        Location::create(['location_name' => 'Bắc Kạn']);
        Location::create(['location_name' => 'Bạc Liêu']);
        Location::create(['location_name' => 'Bắc Ninh']);
        Location::create(['location_name' => 'Bến Tre']);
        Location::create(['location_name' => 'Bình Định']);
        Location::create(['location_name' => 'Bình Dương']);
        Location::create(['location_name' => 'Bình Phước']);
        Location::create(['location_name' => 'Bình Thuận']);
        Location::create(['location_name' => 'Cà Mau']);
        Location::create(['location_name' => 'Cao Bằng']);
        Location::create(['location_name' => 'Đắk Lắk']);
        Location::create(['location_name' => 'Đắk Nông']);
        Location::create(['location_name' => 'Điện Biên']);
        Location::create(['location_name' => 'Đồng Nai']);
        Location::create(['location_name' => 'Đồng Tháp']);
        Location::create(['location_name' => 'Gia Lai']);
        Location::create(['location_name' => 'Hà Giang']);
        Location::create(['location_name' => 'Hà Nam']);
        Location::create(['location_name' => 'Hà Tĩnh']);
        Location::create(['location_name' => 'Hải Dương']);
        Location::create(['location_name' => 'Hậu Giang']);
        Location::create(['location_name' => 'Hòa Bình']);
        Location::create(['location_name' => 'Hưng Yên']);
        Location::create(['location_name' => 'Khánh Hòa']);
        Location::create(['location_name' => 'Kiên Giang']);
        Location::create(['location_name' => 'Kon Tum']);
        Location::create(['location_name' => 'Lai Châu']);
        Location::create(['location_name' => 'Lâm Đồng']);
        Location::create(['location_name' => 'Lạng Sơn']);
        Location::create(['location_name' => 'Lào Cai']);
        Location::create(['location_name' => 'Long An']);
        Location::create(['location_name' => 'Nam Định']);
        Location::create(['location_name' => 'Nghệ An']);
        Location::create(['location_name' => 'Ninh Bình']);
        Location::create(['location_name' => 'Ninh Thuận']);
        Location::create(['location_name' => 'Phú Thọ']);
        Location::create(['location_name' => 'Phú Yên']);
        Location::create(['location_name' => 'Quảng Bình']);
        Location::create(['location_name' => 'Quảng Nam']);
        Location::create(['location_name' => 'Quảng Ngãi']);
        Location::create(['location_name' => 'Quảng Ninh']);
        Location::create(['location_name' => 'Quảng Trị']);
        Location::create(['location_name' => 'Sóc Trăng']);
        Location::create(['location_name' => 'Sơn La']);
        Location::create(['location_name' => 'Tây Ninh']);
        Location::create(['location_name' => 'Thái Bình']);
        Location::create(['location_name' => 'Thái Nguyên']);
        Location::create(['location_name' => 'Thanh Hóa']);
        Location::create(['location_name' => 'Thừa Thiên Huế']);
        Location::create(['location_name' => 'Tiền Giang']);
        Location::create(['location_name' => 'Trà Vinh']);
        Location::create(['location_name' => 'Tuyên Quang']);
        Location::create(['location_name' => 'Vĩnh Long']);
        Location::create(['location_name' => 'Vĩnh Phúc']);
        Location::create(['location_name' => 'Yên Bái']);       
    }
}
