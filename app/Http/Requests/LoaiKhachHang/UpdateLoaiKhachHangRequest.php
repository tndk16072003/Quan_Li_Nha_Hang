<?php

namespace App\Http\Requests\LoaiKhachHang;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoaiKhachHangRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                    => 'required|exists:loai_khach_hangs,id',
            'ten_loai_khach'        => 'required',
            'phan_tram_giam'        => 'required|numeric',
            'list_mon_tang'         => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.*'                    => 'Loại khách hàng không tồn tại!',
            'ten_loai_khach.*'        => 'Tên loại khách không được để trống!',
            'phan_tram_giam.*'        => 'Phần trăm giảm không được để trống!',
            'list_mon_tang.*'         => 'Tặng không được để trống!',
        ];
    }
}
