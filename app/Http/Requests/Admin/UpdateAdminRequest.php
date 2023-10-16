<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'id'                =>  'required|exists:admins,id',
            'email'             =>  'unique:admins,email,' . $this->id,
            'ho_va_ten'         =>  'required|min:5',
            'so_dien_thoai'     =>  'required|digits:10',
            'ngay_sinh'         =>  'required|date',
            'id_quyen'          =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'id.*'                => 'Nhà cung cấp không tồn tại!',
            'email.*'             =>  'Email không được để trống!',
            'ho_va_ten.*'         =>  'Họ và tên không được để trống!',
            'so_dien_thoai.*'     =>  'Số điện thoại phải là 10 số!',
            'ngay_sinh.*'         =>  'Ngày sinh không được để trống!',
            'id_quyen.*'          =>  'Không được để trống quyền!',
        ];
    }
}
