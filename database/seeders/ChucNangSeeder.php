<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucNangSeeder extends Seeder
{
    public function run()
    {
        DB::table('danh_sach_chuc_nangs')->delete();
        DB::table('danh_sach_chuc_nangs')->truncate();

        DB::table('danh_sach_chuc_nangs')->insert([
            [ 'id' => 1, 'ten_chuc_nang'  => 'Tạo Mới Tài Khoản'],
            [ 'id' => 2, 'ten_chuc_nang'  => 'Xem Danh Sách Tài Khoản'],
            [ 'id' => 3, 'ten_chuc_nang'  => 'Đổi Mật Khẩu Tài Khoản'],
            [ 'id' => 4, 'ten_chuc_nang'  => 'Cập Nhật Thông Tin Tài Khoản'],
            [ 'id' => 5, 'ten_chuc_nang'  => 'Xóa Tài Khoản'],
            [ 'id' => 6, 'ten_chuc_nang'  => 'View Tài Khoản'],
            [ 'id' => 7, 'ten_chuc_nang'  => 'View Quyền'],
            [ 'id' => 8, 'ten_chuc_nang'  => 'Xem Danh Sách Quyền'],
            [ 'id' => 9, 'ten_chuc_nang'  => 'Tạo Mới Quyền'],
            [ 'id' => 10, 'ten_chuc_nang'  => 'Xóa Quyền'],
            [ 'id' => 11, 'ten_chuc_nang'  => 'Cập Nhật Quyền'],
            [ 'id' => 12, 'ten_chuc_nang'  => 'View Nhà Cung Cấp'],
            [ 'id' => 13, 'ten_chuc_nang'  => 'Tạo Mới Nhà Cung Cấp'],
            [ 'id' => 14, 'ten_chuc_nang'  => 'Xem Danh Sách Nhà Cung Cấp'],
            [ 'id' => 15, 'ten_chuc_nang'  => 'Xóa Nhà Cung Cấp'],
            [ 'id' => 16, 'ten_chuc_nang'  => 'Cập Nhật Nhà Cung Cấp'],
            [ 'id' => 17, 'ten_chuc_nang'  => 'Đổi Trạng Thái Nhà Cung Cấp'],
            [ 'id' => 18, 'ten_chuc_nang'  => 'View Tiếp Thực'],
            [ 'id' => 19, 'ten_chuc_nang'  => 'Xem Danh Sách Tiếp Thực'],
            [ 'id' => 20, 'ten_chuc_nang'  => 'Cập Nhật Tiếp Thực'],
            [ 'id' => 21, 'ten_chuc_nang'  => 'Cập Nhập Tất Cả Tiếp Thực'],
            [ 'id' => 22, 'ten_chuc_nang'  => 'View Bếp'],
            [ 'id' => 23, 'ten_chuc_nang'  => 'Xem Danh Sách Bếp'],
            [ 'id' => 24, 'ten_chuc_nang'  => 'Cập Nhật Bếp'],
            [ 'id' => 25, 'ten_chuc_nang'  => 'Cập Nhật Tất Cả Bếp'],
            [ 'id' => 26, 'ten_chuc_nang'  => 'View Loại Khách Hàng'],
            [ 'id' => 27, 'ten_chuc_nang'  => 'Xem Danh Sách Loại Khách Hàng'],
            [ 'id' => 28, 'ten_chuc_nang'  => 'Xóa Loại Khách Hàng'],
            [ 'id' => 29, 'ten_chuc_nang'  => 'Thêm Mới Loại Khách Hàng'],
            [ 'id' => 30, 'ten_chuc_nang'  => 'Cập Nhật Loại Khách Hàng'],
            [ 'id' => 31, 'ten_chuc_nang'  => 'Tìm Kiếm Loại Khách Hàng'],
            [ 'id' => 32, 'ten_chuc_nang'  => 'Xóa Tất Cả Loại Khách Hàng'],
            [ 'id' => 33, 'ten_chuc_nang'  => 'View Khách Hàng'],
            [ 'id' => 34, 'ten_chuc_nang'  => 'Tạo Mới Khách Hàng'],
            [ 'id' => 35, 'ten_chuc_nang'  => 'Cập Nhật Khách Hàng'],
            [ 'id' => 36, 'ten_chuc_nang'  => 'Xóa Khách Hàng'],
            [ 'id' => 37, 'ten_chuc_nang'  => 'Tìm Khách Hàng'],
            [ 'id' => 38, 'ten_chuc_nang'  => 'Xem Danh Sách Khách Hàng'],
            [ 'id' => 39, 'ten_chuc_nang'  => 'Xóa Tất Cả Khách Hàng'],
            [ 'id' => 40, 'ten_chuc_nang'  => 'View Bán Hàng'],
            [ 'id' => 41, 'ten_chuc_nang'  => 'View Món Ăn'],
            [ 'id' => 42, 'ten_chuc_nang'  => 'Xem Danh Sách Món Ăn'],
            [ 'id' => 43, 'ten_chuc_nang'  => 'Đổi Trạng Thái Món Ăn'],
            [ 'id' => 44, 'ten_chuc_nang'  => 'Xóa Món Ăn'],
            [ 'id' => 45, 'ten_chuc_nang'  => 'Chỉnh Sửa Món Ăn'],
            [ 'id' => 46, 'ten_chuc_nang'  => 'Thêm Mới Món Ăn'],
            [ 'id' => 47, 'ten_chuc_nang'  => 'Cập Nhật Món Ăn'],
            [ 'id' => 48, 'ten_chuc_nang'  => 'Xóa Tất Cả Món Ăn'],
            [ 'id' => 49, 'ten_chuc_nang'  => 'View Danh Mục'],
            [ 'id' => 50, 'ten_chuc_nang'  => 'Xem Danh Sách Danh Mục'],
            [ 'id' => 51, 'ten_chuc_nang'  => 'Đổi Trạng Thái Danh Mục'],
            [ 'id' => 52, 'ten_chuc_nang'  => 'Xóa Danh Mục'],
            [ 'id' => 53, 'ten_chuc_nang'  => 'Cập Nhật Danh Mục'],
            [ 'id' => 54, 'ten_chuc_nang'  => 'Thêm Mới Danh Mục'],
            [ 'id' => 55, 'ten_chuc_nang'  => 'Xóa Tất Cả Danh Mục'],
            [ 'id' => 56, 'ten_chuc_nang'  => 'View Bàn'],
            [ 'id' => 57, 'ten_chuc_nang'  => 'Xem Danh Sách Bàn'],
            [ 'id' => 58, 'ten_chuc_nang'  => 'Đổi Trạng Thái Bàn'],
            [ 'id' => 59, 'ten_chuc_nang'  => 'Xóa Bàn'],
            [ 'id' => 60, 'ten_chuc_nang'  => 'Thêm Mới Bàn'],
            [ 'id' => 61, 'ten_chuc_nang'  => 'Cập Nhật Bàn'],
            [ 'id' => 62, 'ten_chuc_nang'  => 'Xóa Tất Cả Bàn'],
            [ 'id' => 63, 'ten_chuc_nang'  => 'View Khu Vực'],
            [ 'id' => 64, 'ten_chuc_nang'  => 'Xem Danh Sách Khu Vực'],
            [ 'id' => 65, 'ten_chuc_nang'  => 'Đổi Trạng Thái Khu Vực'],
            [ 'id' => 66, 'ten_chuc_nang'  => 'Xóa Khu Vực'],
            [ 'id' => 67, 'ten_chuc_nang'  => 'Xóa Tất Cả Khu Vực'],
            [ 'id' => 68, 'ten_chuc_nang'  => 'Thêm Mới Khu Vực'],
            [ 'id' => 69, 'ten_chuc_nang'  => 'Cập Nhật Khu Vực'],
            [ 'id' => 70, 'ten_chuc_nang'  => 'View Nhập Hàng'],
            [ 'id' => 71, 'ten_chuc_nang'  => 'Thêm Sản Phẩn Nhập Hàng'],
            [ 'id' => 72, 'ten_chuc_nang'  => 'Xác Nhận Nhập Hàng'],
            [ 'id' => 73, 'ten_chuc_nang'  => 'Danh Sách Nhập Hàng'],
            [ 'id' => 74, 'ten_chuc_nang'  => 'Gửi Mail Nhập Hàng'],
        ]);
    }
}
