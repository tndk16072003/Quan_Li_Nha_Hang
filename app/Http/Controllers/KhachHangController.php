<?php

namespace App\Http\Controllers;

use App\Http\Requests\KhachHang\CreateKhachHangRequest;
use App\Http\Requests\KhachHang\DeleteKhachHangRequest;
use App\Http\Requests\KhachHang\UpdateKhachHangRequest;
use App\Models\KhachHang;
use App\Models\LoaiKhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KhachHangController extends Controller
{

    public function index()
    {
        $x          = $this->checkRule(33);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        $loaiKH = LoaiKhachHang::get();
        return view('admin.page.khach_hang.index', compact('loaiKH'));
    }

    public function store(CreateKhachHangRequest $request)
    {
        $x          = $this->checkRule(34);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $data = $request->all();
        // dd($data);
        if(isset($data['ho_lot'])){
            $data['ho_va_ten'] = $data['ho_lot'] . " " . $data['ten_khach'];
        }else{
            $data['ho_va_ten'] = $data['ten_khach'];
        }
        $data['ma_khach']  = Str::uuid();
        KhachHang::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }

    public function getData()
    {
        $x          = $this->checkRule(38);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $khachHang = KhachHang::join('loai_khach_hangs', 'loai_khach_hangs.id', 'khach_hangs.id_loai_khach')
                              ->select('khach_hangs.*', 'loai_khach_hangs.ten_loai_khach')
                              ->get();

        return response()->json([
            'status'   => 1,
            'data'    => $khachHang,
        ]);
    }

    public function update(UpdateKhachHangRequest $request)
    {
        $x          = $this->checkRule(35);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $khachHang = KhachHang::find($request->id);
        if($khachHang){
            $data = $request->all();
            if(isset($data['ho_lot'])){
                $data['ho_va_ten'] = $data['ho_lot'] . " " . $data['ten_khach'];
            }else{
                $data['ho_va_ten'] = $data['ten_khach'];
            }
            $khachHang->update($data);
            return response()->json([
                'status'        => 1,
                'message'       => 'Đã cập nhật khách hàng thành công',
            ]);
        }
    }

    public function delete(DeleteKhachHangRequest $request)
    {
        $x          = $this->checkRule(36);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $khachHang = KhachHang::find($request->id);
        $khachHang->delete();
        return response()->json([
            'status'        => 1,
            'message'       => 'Đã xóa khách hàng thành công',
        ]);
    }

    public function search(Request $request)
    {
        $x          = $this->checkRule(37);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $list = KhachHang::join('loai_khach_hangs', 'loai_khach_hangs.id', 'khach_hangs.id_loai_khach')
                        ->select('khach_hangs.*', 'loai_khach_hangs.ten_loai_khach')
                        ->where('khach_hangs.ten_khach', 'like', '%' . $request->key_search . '%')
                        ->orWhere('khach_hangs.ho_lot', 'like', '%' . $request->key_search . '%')
                        ->orWhere('khach_hangs.so_dien_thoai', 'like', '%' . $request->key_search . '%')
                        ->orWhere('khach_hangs.email', 'like', '%' . $request->key_search . '%')
                        ->get();

        return response()->json([
            'list'  => $list
        ]);
    }
    public function deleteCheckbox(Request $request)
    {
        $x          = $this->checkRule(39);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $data = $request->all();

        $str = "";

        foreach ($data as $key => $value) {
            if(isset($value['check'])) {
                $str .= $value['id'] . ",";
            }

            $data_id = explode("," , rtrim($str, ","));

            foreach ($data_id as $k => $v) {
                $KhachHang = KhachHang::where('id', $v);

                if($KhachHang) {
                    $KhachHang->delete();
                } else {
                    return response()->json([
                        'status'    => false,
                        'message'   => 'Đã có lỗi sự cố!',
                    ]);
                }
            }
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa thành công!',
        ]);
    }

}
