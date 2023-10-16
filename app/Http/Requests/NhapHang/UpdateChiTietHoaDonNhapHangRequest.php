<?php

namespace App\Http\Requests\NhapHang;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChiTietHoaDonNhapHangRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                    =>  'required|exists:chi_tiet_hoa_don_nhap_hangs,id',
            'so_luong_nhap'         =>  'required|numeric',
            'don_gia_nhap'          =>  'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id.*'                  =>  'Chi tiết bán hàng không tồn tại!',
            'so_luong_nhap.*'       =>  'Số lượng Nhập ít nhất là 0.1',
            'don_gia_nhap.*'        =>  'Đơn giá phải là số!',
        ];
    }
}
