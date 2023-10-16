<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuyenRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'ten_quyen'     => 'required|min:3',
            'list_id_quyen' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ten_quyen.*'     => 'Tên quyền không được để trống!',
            'list_id_quyen.*' => 'List quyền không để trống!',
        ];
    }
}
