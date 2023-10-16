<?php

namespace App\Http\Requests\Ban;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'                =>  'required|exists:bans,id',
            'ten_ban'           =>  'required|min:5|max:30',
            'slug_ban'          =>  'required|min:5|unique:bans,slug_ban, ' . $this->id,
            'gia_mo_ban'        =>  'required|numeric|min:0',
            'tien_gio'          =>  'required|numeric|min:0',
            'tinh_trang'        =>  'required|boolean',
            'id_khu_vuc'        =>  'required|exists:khu_vucs,id',
        ];
    }

    public function messages()
    {
        return [
            'id.*'              =>  'Bàn không tồn tại!',
            'ten_ban.required'  =>  'Yêu cầu phải nhập tên bàn',
            'ten_ban.min'       =>  'Tên bàn phải từ 5 ký tự',
            'ten_ban.max'       =>  'Tên bàn tối đa được 30 ký tự',
            'slug_ban.*'        =>  'Slug bàn đã tồn tại!',
            'gia_mo_ban.*'      =>  'Giá bán ít nhất là 0đ',
            'tien_gio.*'        =>  'Tiền giờ ít nhất là 0đ',
            'tinh_trang.*'      =>  'Vui lòng chọn tình trạng theo yêu cầu!',
        ];
    }
}
