<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhSachChucNang extends Model
{
    use HasFactory;

    protected $table = 'danh_sach_chuc_nangs';

    protected $fillable  = [
        'ten_chuc_nang'
    ];
}
