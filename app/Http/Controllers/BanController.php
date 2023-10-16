<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ban\CreateBanRequest;
use App\Http\Requests\Ban\UpdateBanRequest;
use App\Models\Ban;
use App\Models\KhuVuc;
use Illuminate\Http\Request;

class BanController extends Controller
{
    public function index()
    {
        $x          = $this->checkRule(56);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        $khuVuc = KhuVuc::all();

        return view('admin.page.ban.index', compact('khuVuc'));
    }

    public function index_vue()
    {
        $x          = $this->checkRule(56);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        $khuVuc = KhuVuc::all();
        return view('admin.page.ban.index_vue', compact('khuVuc'));
    }

    public function getData()
    {
        $x          = $this->checkRule(57);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        $list = Ban::join('khu_vucs', 'bans.id_khu_vuc', 'khu_vucs.id')
                   ->select('bans.*', 'khu_vucs.ten_khu')
                   ->orderBy('bans.id')
                   ->get();

        return response()->json([
            'data'  => $list
        ]);
    }

    public function doiTrangThai(Request $request)
    {
        $x          = $this->checkRule(58);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $ban = Ban::find($request->id);

        if($ban) {
            $ban->tinh_trang = !$ban->tinh_trang;
            $ban->save();

            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Bàn không tồn tại!'
            ]);
        }
    }

    public function edit(Request $request)
    {
        $ban = Ban::find($request->id);

        if($ban) {
            return response()->json([
                'status'    => true,
                'message'   => 'Đã lấy được dữ liệu!',
                'ban'    => $ban,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Bàn không tồn tại!'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $x          = $this->checkRule(59);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $ban = Ban::find($request->id);

        if($ban) {
            $ban->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xóa bàn thành công!'
            ]);

        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Bàn không tồn tại!'
            ]);
        }
    }

    public function store(CreateBanRequest $request)
    {
        $x          = $this->checkRule(60);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $data = $request->all();

        Ban::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới thành công!',
        ]);
    }

    public function checkSlug(Request $request)
    {
        if(isset($request->id)) {
            $check = Ban::where('slug_ban', $request->slug_ban)
                        ->where('id', '<>', $request->id)
                        ->first();
        } else {
            $check = Ban::where('slug_ban', $request->slug_ban)->first();
        }

        if($check) {
            return response()->json([
                'status'    => false,
                'message'   => 'Tên bàn đã tồn tại!',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Tên bàn có thể sử dụng!',
            ]);
        }
    }

    public function update(UpdateBanRequest $request)
    {
        $x          = $this->checkRule(61);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $ban = Ban::where('id', $request->id)->first();

        $data = $request->all();

        $ban->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }
    public function deleteCheckbox(Request $request)
    {
        $x          = $this->checkRule(62);
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
                $Ban = Ban::where('id', $v);

                if($Ban) {
                    $Ban->delete();
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
