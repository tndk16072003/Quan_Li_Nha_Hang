<?php

namespace App\Http\Requests\KhachHang;

use Illuminate\Foundation\Http\FormRequest;

class CreateKhachHangRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'ho_lot'            => 'nullable',
            'ten_khach'         => 'required',
            'so_dien_thoai'     => 'required|numeric',
            'email'             => 'nullable',
            'ghi_chu'           => 'nullable',
            'ngay_sinh'         => 'nullable',
            'id_loai_khach'     => 'required',
            'ma_so_thue'        => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'ten_khach.*'         => 'Tên Khách hông được để trống!',
            'so_dien_thoai.*'     => 'Số điện thoại Không được để trống!',
            'id_loai_khach.*'     => 'Loại kháchkhông được để trống!',
        ];
    }
}
