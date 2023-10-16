<?php

namespace App\Http\Requests\NhapHang;

use Illuminate\Foundation\Http\FormRequest;

class AddMonAnVaoHoaDonNhapRequest extends FormRequest
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
            'id' => 'required|exists:mon_ans,id'
        ];
    }

    public function messages()
    {
        return [
            'id.*'                =>  'Món ăn không tồn tại!',
        ];
    }


}
