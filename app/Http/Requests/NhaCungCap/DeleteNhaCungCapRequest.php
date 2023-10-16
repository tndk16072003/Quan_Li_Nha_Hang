<?php

namespace App\Http\Requests\NhaCungCap;

use Illuminate\Foundation\Http\FormRequest;

class DeleteNhaCungCapRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id'    => 'exists:nha_cung_caps,id',
        ];
    }
    public function messages()
    {
        return [
            'id.*'                          => 'Nhà cung cấp không tồn tại!',

        ];
    }
}
