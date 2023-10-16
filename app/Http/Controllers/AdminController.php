<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ChangePassWordAdminRequest;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\DeleteAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Mail\NhapHangMail;
use App\Mail\QuenMatKhau;
use App\Models\Admin;
use App\Models\ChiTietHoaDonNhapHang;
use App\Models\HoaDonNhapHang;
use App\Models\Quyen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function testMail()
    {
        $id = 1;
        $donHang = HoaDonNhapHang::where('nha_cung_caps.id', $id)
                                 ->join('nha_cung_caps', 'nha_cung_caps.id', 'hoa_don_nhap_hangs.id_nha_cung_cap')
                                 ->select('hoa_don_nhap_hangs.*', 'nha_cung_caps.ten_cong_ty', 'nha_cung_caps.email')
                                 ->first();

        $chiTietNhapHang = ChiTietHoaDonNhapHang::where('id_hoa_don_nhap_hang', $id)->get();

        $data = [
            'donHang' => $donHang,
            'chiTietNhapHang' => $chiTietNhapHang
        ];

        Mail::to($donHang->email)->send(new NhapHangMail($data));

        dd(1);
    }
    public function viewUpdatePass($hash_reset)
    {
        $taiKhoan = Admin::where('hash_reset', $hash_reset)->first();
        if($taiKhoan) {
            return view('admin.page.update_pass', compact('hash_reset'));
        } else {
            toastr()->error('Dữ liệu không tồn tại!');
            return redirect('/admin/login');
        }
    }

    public function actionUpdatePass(Request $request)
    {
        if($request->password != $request->re_password) {
            toastr()->error('Mật khẩu không trùng nhau!');
            return redirect()->back();
        }
        $taiKhoan = Admin::where('hash_reset', $request->hash_reset)->first();
        if(!$taiKhoan) {
            toastr()->error('Dữ liệu không tồn tại!');
            return redirect()->back();
        } else {
            $taiKhoan->password   = bcrypt($request->password);
            $taiKhoan->hash_reset = NULL;
            $taiKhoan->save();
            toastr()->success('Đã đổi mật khẩu thành công!');
            return redirect('/admin/login');
        }
    }

    public function viewLostPass()
    {
        return view('admin.page.lost_password');
    }

    public function actionLostPass(Request $request)
    {
        $taiKhoan   = Admin::where('email', $request->email)->first();
        if($taiKhoan) {
            $now    = Carbon::now();
            $time   = $now->diffInMinutes($taiKhoan->updated_at);
            if(!$taiKhoan->hash_reset || $time > 0) {
                $taiKhoan->hash_reset = Str::uuid();
                $taiKhoan->save();

                $link    = env('APP_URL') . '/admin/update-password/' . $taiKhoan->hash_reset;

                Mail::to($taiKhoan->email)->send(new QuenMatKhau($link));
            }
            toastr()->success("Vui lòng kiểm tra email!");
            return redirect('/admin/login');

        } else {
            toastr()->error("Tài khoản không tồn tại!");
            return redirect('/admin/lost-password');
        }
    }

    public function actionLogout()
    {
        Auth::guard('aloxinh')->logout();
        toastr()->error("Tài khoản đã đăng xuất!");
        return redirect('/');
    }

    public function viewLogin()
    {
        $check = Auth::guard('aloxinh')->check();
        if($check) {
            return redirect('/admin/khu-vuc');
        } else {
            return view('admin.page.login');
        }
    }

    public function actionLogin(Request $request)
    {
        // $request->email, $request->password
        $check =  Auth::guard('aloxinh')->attempt([
                                        'email'     => $request->email,
                                        'password'  => $request->password
                                    ]);
        if($check) {
            toastr()->success("Đã đăng nhập thành công!");
            return redirect('/');
        } else {
            toastr()->error("Tài khoản hoặc mật khẩu không đúng!");
            return redirect('/admin/login');
        }
    }

    public function index()
    {
        $x          = $this->checkRule(6);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        $quyen = Quyen::get();
        return view('admin.page.tai_khoan.index', compact('quyen'));
    }

    public function store(CreateAdminRequest $request)
    {
        $x          = $this->checkRule(1);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }

        $data = $request->all();
        $data['password'] =  bcrypt($request->password);
        Admin::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo tài khoản thành công!'
        ]);
    }

    public function getData()
    {
        $list = Admin::leftjoin('quyens', 'admins.id_quyen', 'quyens.id')
                     ->select('admins.*', 'quyens.ten_quyen')
                     ->get();
        return response()->json([
            'list'  => $list
        ]);
    }

    public function destroy(DeleteAdminRequest $request)
    {
        // $x          = $this->checkRule(5);
        // if($x)  {
        //     return response()->json([
        //         'status'    => 0,
        //         'message'   => 'Bạn không đủ quyền',
        //     ]);
        // }

        $admin = Admin::where('id', $request->id)->first();
        $admin->delete();
        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa thành công!',
        ]);
    }

    public function update(UpdateAdminRequest $request)
    {
        // $x          = $this->checkRule(4);
        // if($x)  {
        //     return response()->json([
        //         'status'    => 0,
        //         'message'   => 'Bạn không đủ quyền',
        //     ]);
        // }

        $data    = $request->all();
        $admin = Admin::find($request->id);
        $admin->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật thành công!',
        ]);
    }

    public function changePassword(ChangePassWordAdminRequest $request)
    {
        // $x          = $this->checkRule(3);
        // if($x)  {
        //     return response()->json([
        //         'status'    => 0,
        //         'message'   => 'Bạn không đủ quyền',
        //     ]);
        // }

        $data = $request->all();
        if(isset($request->password)){
            $admin = Admin::find($request->id);
            $data['password'] = bcrypt($data['password_new']);
            $admin->password  = $data['password'];
            $admin->save();
        }
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã cập nhật mật khẩu thành công!',
        ]);
    }
}
