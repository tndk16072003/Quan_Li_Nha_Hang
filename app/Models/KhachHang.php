<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;

    protected $table = "khach_hangs";
    protected $fillable = [
        'ma_khach',
        'ho_va_ten',
        'ho_lot',
        'ten_khach',
        'so_dien_thoai',
        'email',
        'ghi_chu',
        'ngay_sinh',
        'id_loai_khach',
        'ma_so_thue',
    ];
}
