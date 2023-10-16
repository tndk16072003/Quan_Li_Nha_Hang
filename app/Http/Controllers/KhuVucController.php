<?php

namespace App\Http\Controllers;

use App\Http\Requests\KhuVuc\CreateKhuVucRequest;
use App\Http\Requests\KhuVuc\UpdateKhuVucRequest;
use App\Models\Ban;
use App\Models\KhuVuc;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class KhuVucController extends Controller
{
    public function index()
    {
        $x          = $this->checkRule(63);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        return view('admin.page.khu_vuc.index');
    }

    public function index_vue()
    {
        $x          = $this->checkRule(63);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        return view('admin.page.khu_vuc.index_vue');
    }

    public function getData()
    {
        $x          = $this->checkRule(64);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        $list = KhuVuc::get(); //KhuVuc::all();

        return response()->json([
            'list'  => $list
        ]);
    }

    public function doiTrangThai(Request $request)
    {
        $x          = $this->checkRule(65);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $khuVuc = KhuVuc::find($request->id);

        if($khuVuc) {
            $khuVuc->tinh_trang = !$khuVuc->tinh_trang;
            $khuVuc->save();

            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Khu vực không tồn tại!'
            ]);
        }
    }

    public function edit(Request $request)
    {
        $khuVuc = KhuVuc::find($request->id);

        if($khuVuc) {
            return response()->json([
                'status'    => true,
                'message'   => 'Đã lấy được dữ liệu!',
                'khuVuc'    => $khuVuc,
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
        $x          = $this->checkRule(66);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $khuVuc = KhuVuc::find($request->id);

        if($khuVuc) {
            $ban = Ban::where('id_khu_vuc', $request->id)->first();

            if($ban) {
                return response()->json([
                    'status'    => 2,
                    'message'   => 'Khu vực này đang có bàn, bạn không thể xóa!'
                ]);
            } else {
                $khuVuc->delete();

                return response()->json([
                    'status'    => true,
                    'message'   => 'Đã xóa khu vực thành công!'
                ]);
            }
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Khu vực không tồn tại!'
            ]);
        }
    }

    public function destroyAll(Request $request)
    {
        $x          = $this->checkRule(67);
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
                $khuVuc = KhuVuc::where('id', $v);

                if($khuVuc) {
                    $khuVuc->delete();
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

    public function store(CreateKhuVucRequest $request)
    {
        $x          = $this->checkRule(68);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $data = $request->all();

        $check = KhuVuc::where('slug_khu', $request->slug_khu)->first();
        if(!$check){
            KhuVuc::create($data);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã tạo mới thành công!',
            ]);
        }
    }

    public function checkSlug(Request $request)
    {
        if(isset($request->id)) {
            $check = KhuVuc::where('slug_khu', $request->slug_khu)
                            ->where('id', '<>', $request->id)
                            ->first();
        } else {
            $check = KhuVuc::where('slug_khu', $request->slug_khu)->first();
        }

        if($check) {
            return response()->json([
                'status'    => false,
                'message'   => 'Tên khu đã tồn tại!',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Tên khu có thể sử dụng!',
            ]);
        }
    }

    public function update(UpdateKhuVucRequest $request)
    {
        $x          = $this->checkRule(69);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $khu_vuc = KhuVuc::where('id', $request->id)->first();

        $data = $request->all();

        $khu_vuc->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }
}
