<?php

namespace App\Http\Requests\HoaDon;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChiTietBanHangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                =>  'required|exists:chi_tiet_ban_hangs,id',
            'so_luong_ban'      =>  'required|numeric',
            'ghi_chu'           =>  'nullable',
            'tien_chiet_khau'   =>  'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id.*'                =>  'Chi tiết bán hàng không tồn tại!',
            'so_luong_ban.*'      =>  'Số lượng bán ít nhất là 0.1',
            'ghi_chu.*'           =>  'Số lượng bán ít nhất là 0.1',
            'tien_chiet_khau.*'   =>  'Tiền chiết khấu phải là số!',
        ];
    }
}
