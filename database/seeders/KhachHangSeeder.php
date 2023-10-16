<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class KhachHangSeeder extends Seeder
{

    public function run()
    {
        DB::table('khach_hangs')->delete();
        DB::table('khach_hangs')->truncate();

        DB::table('khach_hangs')->insert([
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Võ Thị Như Yên',
                'ho_lot'        =>  'Võ Thị Như',
                'ten_khach'     =>  'Yên',
                'so_dien_thoai' =>  '0848822072',
                'email'         =>  'vothinhuyen22042003@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Hoàng Phan Văn Ý',
                'ho_lot'        =>  'Hoàng Phan Văn',
                'ten_khach'     =>  'Ý',
                'so_dien_thoai' =>  '0974048425',
                'email'         =>  'hpvy.work@gmail.com',
                'ghi_chu'       =>  null,
                'id_loai_khach' =>  3,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Trương Quang Vinh',
                'ho_lot'        =>  'Trương Quang',
                'ten_khach'     =>  'Vinh',
                'so_dien_thoai' =>  '0337317578',
                'email'         =>  'Truongquangvinh1999@gmail.com',
                'ghi_chu'       =>  null,
                'id_loai_khach' =>  4,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Bùi Văn Tứ',
                'ho_lot'        =>  'Bùi Văn',
                'ten_khach'     =>  'Tứ',
                'so_dien_thoai' =>  '0386452527',
                'email'         =>  'buivantu2106@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Trần Ngọc Tiến',
                'ho_lot'        =>  'Trần Ngọc',
                'ten_khach'     =>  'Tiến',
                'so_dien_thoai' =>  '0903526897',
                'email'         =>  'ngoctien10082003@gmail.com',
                'ghi_chu'       =>  null,
                'id_loai_khach' =>  1,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Hồ Thị Thanh Thanh',
                'ho_lot'        =>  'Hồ Thị Thanh',
                'ten_khach'     =>  'Thanh',
                'so_dien_thoai' =>  '0835633234',
                'email'         =>  'Thanhthanh186203@gmail.com',
                'ghi_chu'       =>  null,
                'id_loai_khach' =>  3,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Lê Quốc An',
                'ho_lot'        =>  'Lê Quốc',
                'ten_khach'     =>  'An',
                'so_dien_thoai' =>  '0866033921',
                'email'         =>  'atmint76@gmail.com',
                'ghi_chu'       =>  'Khách thích ăn cay',
                'id_loai_khach' =>  1,
                'ma_so_thue'    =>  '0300816663',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Vũ Duy',
                'ho_lot'        =>  'Nguyễn Vũ',
                'ten_khach'     =>  'Duy',
                'so_dien_thoai' =>  '0974181076',
                'email'         =>  'vuduy231109@gmail.com',
                'ghi_chu'       =>  'Khách không thích ăn hành',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0300588569',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Phước Thiên Đức',
                'ho_lot'        =>  'Nguyễn Phước Thiên',
                'ten_khach'     =>  'Đức',
                'so_dien_thoai' =>  '0935874992',
                'email'         =>  'duc09092001@gmail.com',
                'ghi_chu'       =>  'Khách thích có nhân viên xinh đứng cạnh phục vụ bàn',
                'id_loai_khach' =>  3,
                'ma_so_thue'    =>  '0107894416',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Từ Lê Thu Hiền',
                'ho_lot'        =>  'Từ Lê Thu',
                'ten_khach'     =>  'Hiền',
                'so_dien_thoai' =>  '0333314445',
                'email'         =>  'tulethuhien@gmail.com',
                'ghi_chu'       =>  'Khách thích ăn tôm có 5 chân chứ không thích tôm 6 chân',
                'id_loai_khach' =>  4,
                'ma_so_thue'    =>  '0309532909',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Trung Hiếu',
                'ho_lot'        =>  'Nguyễn Trung',
                'ten_khach'     =>  'Hiếu',
                'so_dien_thoai' =>  '0914804504',
                'email'         =>  'hieu0916627436@gmail.com',
                'ghi_chu'       =>  'Khách thích ăn nhiều hành',
                'id_loai_khach' =>  1,
                'ma_so_thue'    =>  '0402147161',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Trần Văn Hiếu',
                'ho_lot'        =>  'Nguyễn Trần Văn',
                'ten_khach'     =>  'Hiếu',
                'so_dien_thoai' =>  '0768581467',
                'email'         =>  'hieukn1@gmail.com',
                'ghi_chu'       =>  'Khách thích ăn ớt nhưng k cay',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '3700344643',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Văn Hiếu',
                'ho_lot'        =>  'Nguyễn Văn',
                'ten_khach'     =>  'Hiếu',
                'so_dien_thoai' =>  '0898219157',
                'email'         =>  'nguyenvanhieu20020831@gmail.com',
                'ghi_chu'       =>  'Khách không thích ăn hành nhưng hành phi thì cũng không ăn được',
                'id_loai_khach' =>  3,
                'ma_so_thue'    =>  '4601124536',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Ngọc Hưng',
                'ho_lot'        =>  'Nguyễn Ngọc',
                'ten_khach'     =>  'Hưng',
                'so_dien_thoai' =>  '0123456789',
            'email'         =>  'luongdienmat@gmail.com',
                'ghi_chu'       =>  'Khách ăn chay nhưng thèm thịt gà',
                'id_loai_khach' =>  4,
                'ma_so_thue'    =>  '0106034513',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Lê Trọng Huy',
                'ho_lot'        =>  'Lê Trọng',
                'ten_khach'     =>  'Huy',
                'so_dien_thoai' =>  '0983057130',
                'email'         =>  'hale.02031982@gmail.com',
                'ghi_chu'       =>  'Khách sộp thích bo nhưng mà là ki bo',
                'id_loai_khach' =>  1,
                'ma_so_thue'    =>  '0313506115',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Quang Huy',
                'ho_lot'        =>  'Nguyễn Quang',
                'ten_khach'     =>  'Huy',
                'so_dien_thoai' =>  '0905758603',
                'email'         =>  'nguyenhuyilc2003@gmail.com',
                'ghi_chu'       =>  'Khách hơi khó tính được cái dễ chịu',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0102180545',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Trương Quang Huynh',
                'ho_lot'        =>  'Trương Quang',
                'ten_khach'     =>  'Huynh',
                'so_dien_thoai' =>  '0123456789',
                'email'         =>  'Huynhkinh1998@gmail.com',
                'ghi_chu'       =>  'Khách đẹp chai nhưng được cái nghèo',
                'id_loai_khach' =>  3,
                'ma_so_thue'    =>  '0107490572',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Trần Thanh Khoa',
                'ho_lot'        =>  'Trần Thanh',
                'ten_khach'     =>  'Khoa',
                'so_dien_thoai' =>  '0777417860',
                'email'         =>  'khoa22012@gmail.com',
                'ghi_chu'       =>  'Khách không có tiền nhưng thích ăn sang',
                'id_loai_khach' =>  4,
                'ma_so_thue'    =>  '3702877679',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Trần Tuấn Kiệt',
                'ho_lot'        =>  'Trần Tuấn',
                'ten_khach'     =>  'Kiệt',
                'so_dien_thoai' =>  '0905718435',
                'email'         =>  'hinem04@gmail.com',
                'ghi_chu'       =>  'Khách không thích bị ăn hành',
                'id_loai_khach' =>  1,
                'ma_so_thue'    =>  '0303217354',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Văn Lành',
                'ho_lot'        =>  'Nguyễn Văn',
                'ten_khach'     =>  'Lành',
                'so_dien_thoai' =>  '0978318197',
                'email'         =>  'Lanhnguyen150597@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Thành Long',
                'ho_lot'        =>  'Nguyễn Thành',
                'ten_khach'     =>  'Long',
                'so_dien_thoai' =>  '0905807623',
                'email'         =>  'Longkolp16@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
            'ho_va_ten'     =>  'Võ Công Mạnh',
                'ho_lot'        =>  'Võ Công',
                'ten_khach'     =>  'Mạnh',
                'so_dien_thoai' =>  '0935977057',
                'email'         =>  'manhvocong@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Huỳnh Công Minh',
                'ho_lot'        =>  'Huỳnh Công',
                'ten_khach'     =>  'Minh',
                'so_dien_thoai' =>  '0705228376',
                'email'         =>  'congminh1271995@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Hoài Nam',
                'ho_lot'        =>  'Nguyễn Hoài',
                'ten_khach'     =>  'Nam',
                'so_dien_thoai' =>  '0839857345',
                'email'         =>  'namhoai21092017@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Lê Trọng Nhân',
                'ho_lot'        =>  'Lê Trọng',
                'ten_khach'     =>  'Nhân',
                'so_dien_thoai' =>  '0123456789',
                'email'         =>  'nhanle2709@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Ngọc Phúc',
                'ho_lot'        =>  'Nguyễn Ngọc',
                'ten_khach'     =>  'Phúc',
                'so_dien_thoai' =>  '0947282357',
                'email'         =>  'Nphucn841@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Lê Minh Quân',
                'ho_lot'        =>  'Lê Minh',
                'ten_khach'     =>  'Quân',
                'so_dien_thoai' =>  '0123456789',
                'email'         =>  'lminhquan202@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Trần Lê Minh Quân',
                'ho_lot'        =>  'Trần Lê Minh',
                'ten_khach'     =>  'Quân',
                'so_dien_thoai' =>  '0919586720',
                'email'         =>  'quantran6102002@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Lê Trọng Quỳnh',
                'ho_lot'        =>  'Lê Trọng',
                'ten_khach'     =>  'Quỳnh',
                'so_dien_thoai' =>  '0777462383',
                'email'         =>  'quynhle24082001@gmail.com',
            'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Thiện Tài',
                'ho_lot'        =>  'Nguyễn Thiện',
                'ten_khach'     =>  'Tài',
                'so_dien_thoai' =>  '0947292778',
                'email'         =>  'thientaidis@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
            [
                'ma_khach'      =>  Str::uuid(),
                'ho_va_ten'     =>  'Nguyễn Như Tài',
                'ho_lot'        =>  'Nguyễn Như',
                'ten_khach'     =>  'Tài',
                'so_dien_thoai' =>  '0123456789',
                'email'         =>  'nhutai16062001@gmail.com',
                'ghi_chu'       =>  'Khách con nhà lính tính ăn mà không trả tiền',
                'id_loai_khach' =>  2,
                'ma_so_thue'    =>  '0314525618',
            ],
        ]);
    }
}