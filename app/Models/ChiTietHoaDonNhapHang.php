<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDonNhapHang extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_hoa_don_nhap_hangs';
    protected $fillable = [
        'id_mon_an',
        'ten_mon_an',
        'so_luong_nhap',
        'don_gia_nhap',
        'thanh_tien',
        'id_hoa_don_nhap_hang',
        'ghi_chu',
        'trang_thai',
    ];
}
