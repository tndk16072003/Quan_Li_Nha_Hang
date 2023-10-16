<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiKhachHangSeeder extends Seeder
{

    public function run()
    {
        DB::table('loai_khach_hangs')->delete();
        DB::table('loai_khach_hangs')->truncate();

        DB::table('loai_khach_hangs')->insert([
            [
                'ten_loai_khach'        => 'Khách Du Lịch',
                'phan_tram_giam'        => 20,
                'list_mon_tang'         => 'Bánh tráng,Cá khô',
            ],

            [
                'ten_loai_khach'        => 'Khách Nước Ngoài',
                'phan_tram_giam'        => 15,
                'list_mon_tang'         => 'Bia,Nướt ngọt',
            ],

            [
                'ten_loai_khach'        => 'Khách Ngoại Thành',
                'phan_tram_giam'        => 10,
                'list_mon_tang'         => 'Túi,Mũ',
            ],

            [
                'ten_loai_khach'        => 'Khách Nội Thành',
                'phan_tram_giam'        => 5,
                'list_mon_tang'         => 'Bánh,Hoa',
            ],
        ]);
    }
}
