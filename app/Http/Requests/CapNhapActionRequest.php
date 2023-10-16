<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapNhapActionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id_quyen'        => 'required|exists:quyens,id',
        ];
    }

    public function messages()
    {
        return [
            'id_quyen.*'    => 'Vui lòng chọn quyền để cập nhập phân quyền!',
        ];
    }
}
