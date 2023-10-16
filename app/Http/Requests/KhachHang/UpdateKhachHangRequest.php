<?php

namespace App\Http\Requests\KhachHang;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKhachHangRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                => 'required|exists:khach_hangs,id',
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
            'id.*'                => 'Khách hàng không tồn tại!',
            'ten_khach.*'         => 'Tên Khách hông được để trống!',
            'so_dien_thoai.*'     => 'Số điện thoại Không được để trống!',
            'id_loai_khach.*'     => 'Loại kháchkhông được để trống!',
        ];
    }
}
