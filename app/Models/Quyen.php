<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    use HasFactory;

    protected $table = "quyens";
    protected $fillable = [
        'ten_quyen',
        'list_id_quyen',
    ];
}
