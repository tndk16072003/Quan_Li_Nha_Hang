<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            [
                'ho_va_ten'             => "Admin",
                'email'                 => "admin@master.com",
                'so_dien_thoai'         => "0333314445",
                'ngay_sinh'             => "2001-05-04",
                'password'              => bcrypt("123456"),
                'id_quyen'              => 1,
            ]
        ]);
    }
}
