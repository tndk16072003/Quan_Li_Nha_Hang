<?php

namespace App\Http\Requests\DanhMuc;

use Illuminate\Foundation\Http\FormRequest;

class CreateDanhMucRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten_danh_muc'      =>  'required|min:3|max:30',
            'tinh_trang'        =>  'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'ten_danh_muc.required'  =>  'Yêu cầu phải nhập tên danh mục',
            'ten_danh_muc.min'       =>  'Tên danh mục phải từ 3 ký tự',
            'ten_danh_muc.max'       =>  'Tên danh mục tối đa được 30 ký tự',
            'tinh_trang.*'           =>  'Vui lòng chọn tình trạng theo yêu cầu!',
        ];
    }
}
