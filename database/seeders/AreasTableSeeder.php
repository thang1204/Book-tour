<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            ['name' => 'Hà Nội', 'thumbnail' => 'images/ha_noi.jpg'],
            ['name' => 'TP. Hồ Chí Minh', 'thumbnail' => 'images/ho_chi_minh.jpg'],
            ['name' => 'Đà Nẵng', 'thumbnail' => 'images/da_nang.jpg'],
            ['name' => 'Hội An', 'thumbnail' => 'images/hoi_an.jpg'],
            ['name' => 'Huế', 'thumbnail' => 'images/hue.jpg'],
            ['name' => 'Nha Trang', 'thumbnail' => 'images/nha_trang.jpg'],
            ['name' => 'Hà Giang', 'thumbnail' => 'images/ha_giang.jpg'],
            ['name' => 'Phú Quốc', 'thumbnail' => 'images/phu_quoc.jpg'],
            ['name' => 'Sa Pa', 'thumbnail' => 'images/sapa.jpg'],
            ['name' => 'Hạ Long', 'thumbnail' => 'images/quang_ninh.jpg'],
        ]);
    }
}
