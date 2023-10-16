<?php

namespace App\Http\Requests\KhuVuc;

use Illuminate\Foundation\Http\FormRequest;

class CreateKhuVucRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ten_khu'           =>  'required|min:5|max:30',
            'slug_khu'          =>  'required|min:5|unique:khu_vucs,slug_khu',
            'tinh_trang'        =>  'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'ten_khu.required'  =>  'Yêu cầu phải nhập tên khu',
            'ten_khu.min'       =>  'Tên khu phải từ 5 ký tự',
            'ten_khu.max'       =>  'Tên khu tối đa được 30 ký tự',
            'slug_khu.*'        =>  'Slug khu đã tồn tại!',
            'tinh_trang.*'      =>  'Vui lòng chọn tình trạng theo yêu cầu!',
        ];
    }
}
