<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietBanHang extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_ban_hangs';

    protected $fillable = [
        'id_hoa_don_ban_hang',
        'id_mon_an',
        'ten_mon_an',
        'so_luong_ban',
        'don_gia_ban',
        'tien_chiet_khau',
        'thanh_tien',
        'ghi_chu',
        'is_che_bien',
        'thoi_gian_che_bien',
        'is_tiep_thuc',
        'is_in_bep',
    ];
}
