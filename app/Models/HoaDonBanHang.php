<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonBanHang extends Model
{
    use HasFactory;

    protected $table = 'hoa_don_ban_hangs';

    protected $fillable = [
        'ma_hoa_don_ban_hang',
        'tong_tien',
        'giam_gia',
        'id_ban',
        'id_khach_hang',
        'id_nhan_vien',
        'trang_thai',
        'id_loai_thanh_toan',
        'ghi_chu_loai_thanh_toan',
        'is_xac_nhan',
        'ngay_thanh_toan',
    ];
}
