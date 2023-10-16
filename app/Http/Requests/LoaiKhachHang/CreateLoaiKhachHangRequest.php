<?php

namespace App\Http\Requests\LoaiKhachHang;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoaiKhachHangRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten_loai_khach'        => 'required',
            'phan_tram_giam'        => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'ten_loai_khach.*'        => 'Tên loại khách không được để trống!',
            'phan_tram_giam.*'        => 'Phần trăm giảm không được để trống!',
        ];
    }
}
