<?php

namespace App\Http\Requests\LoaiKhachHang;

use Illuminate\Foundation\Http\FormRequest;

class DeleteLoaiKhachHangRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id' => 'required|exists:loai_khach_hangs,id'
        ];
    }

    public function messages()
    {
        return [
            'id.*' => 'Loại khách hàng không tồn tại!'
        ];
    }
}
