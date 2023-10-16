<?php

namespace App\Http\Controllers;

use App\Http\Requests\DanhMuc\CreateDanhMucRequest;
use App\Http\Requests\DanhMuc\UpdateDanhMucRequest;
use App\Models\Ban;
use App\Models\DanhMuc;
use App\Models\KhuVuc;
use App\Models\MonAn;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function index()
    {
        $x          = $this->checkRule(49);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        return view('admin.page.danh_muc.index');
    }

    public function index_vue()
    {
        $x          = $this->checkRule(49);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        return view('admin.page.danh_muc.index_vue');
    }

    public function getData()
    {
        $x          = $this->checkRule(50);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        $list = DanhMuc::get();

        return response()->json([
            'list'  => $list
        ]);
    }

    public function doiTrangThai(Request $request)
    {
        $x          = $this->checkRule(51);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $danhMuc = DanhMuc::find($request->id);

        if($danhMuc) {
            $danhMuc->tinh_trang = !$danhMuc->tinh_trang;
            $danhMuc->save();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Món ăn không tồn tại!'
            ]);
        }
    }

    public function edit(Request $request)
    {
        $danhMuc = DanhMuc::find($request->id);

        if($danhMuc) {
            return response()->json([
                'status'    => true,
                'message'   => 'Đã lấy được dữ liệu!',
                'danhMuc'    => $danhMuc,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Khu vực không tồn tại!'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $x          = $this->checkRule(52);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $danhMuc = DanhMuc::find($request->id);

        if($danhMuc) {
            $ban = Ban::where('id_khu_vuc', $request->id)->first();

            if($ban) {
                return response()->json([
                    'status'    => 2,
                    'message'   => 'Khu vực này đang có bàn, bạn không thể xóa!'
                ]);
            } else {
                $danhMuc->delete();

                return response()->json([
                    'status'    => true,
                    'message'   => 'Đã xóa Danh mục thành công!'
                ]);
            }
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Danh mục không tồn tại!'
            ]);
        }
    }

    public function store(CreateDanhMucRequest $request)
    {
        $x          = $this->checkRule(54);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $data = $request->all();

        DanhMuc::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }

    public function update(UpdateDanhMucRequest $request)
    {
        $x          = $this->checkRule(53);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $danhmuc = DanhMuc::where('id', $request->id)->first();

        $data = $request->all();

        $danhmuc->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }
    public function deleteCheckbox(Request $request)
    {
        $x          = $this->checkRule(55);
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
                $DanhMuc = DanhMuc::where('id', $v);

                if($DanhMuc) {
                    $DanhMuc->delete();
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
