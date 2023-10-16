<?php

namespace App\Http\Requests\NhapHang;

use Illuminate\Foundation\Http\FormRequest;

class KiemTraIdNhapHangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:chi_tiet_hoa_don_nhap_hangs,id'
        ];
    }

    public function messages()
    {
        return [
            'id.*'                =>  'Món ăn không tồn tại!',
        ];
    }
}
