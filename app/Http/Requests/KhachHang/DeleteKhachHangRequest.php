<?php

namespace App\Http\Requests\KhachHang;

use Illuminate\Foundation\Http\FormRequest;

class DeleteKhachHangRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:khach_hangs,id'
        ];
    }

    public function messages()
    {
        return [
            'id.*' => 'Khách hàng không tồn tại!',
        ];
    }
}
