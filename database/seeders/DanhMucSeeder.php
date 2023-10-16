<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
{
    public function run()
    {
        DB::table('danh_mucs')->delete();
        DB::table('danh_mucs')->truncate();

        DB::table('danh_mucs')->insert([
            [
                'ten_danh_muc'  => 'Khai Vị',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Gỏi/Salad',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Món Ăn Kèm',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Hải Sản',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Chiên, xào, om',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Lẩu các loại',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Đồ Nhúng',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Đồ Uống',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Đồ Gọi Thêm',
                'tinh_trang'    => random_int(0, 1),
            ],
        ]);
    }
}
