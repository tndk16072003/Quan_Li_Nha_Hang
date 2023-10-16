<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonNhapHang extends Model
{
    use HasFactory;
    protected $table ='hoa_don_nhap_hangs';
    protected $fillable = [
        'id_nha_cung_cap',
        'tong_tien_nhap',
        'ma_hoa_don_nhap_hang',
        'ngay_nhap_hang',
        'id_nhan_vien',
    ];
}
