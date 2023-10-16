<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiKhachHang extends Model
{
    use HasFactory;
    protected $table = "loai_khach_hangs";
    protected $fillable = [
        'ten_loai_khach',
        'phan_tram_giam',
        'list_mon_tang',
    ];
}
