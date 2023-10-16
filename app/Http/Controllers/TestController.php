<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;

class TestController extends Controller
{
    public function index()
    {
        return view('admin.page.demo');
    }
    public function testthongke()
    {
        return view('admin.page.thong_ke.index');
    }

    public function viewTaiKhoan()
    {
        return view('admin.page.tai_khoan.index');
    }

    public function viewLogin()
    {
        return view('admin.page.login');
    }

    public function HamDemo()
    {
        // Hàm này viết cho method get truy cập bằng Link
        $check = $this->checkRule_get(21);
        if(!$check) {
            toastr()->error('Bạn không có quyền truy cập chức năng này!');
            return redirect('/admin');
        }

        // Hàm này viết cho method get data bằng js
        $check = $this->checkRule_get();
        if(!$check) {
            return response()->json([
                'status'  => false,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }

        // Hàm này viết cho method post bằng js
        $check = $this->checkRule_post();
        if(!$check) {
            return response()->json([
                'status'  => false,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }

        // Hàm này viết cho method post bằng form
        $check = $this->checkRule_post();
        if(!$check) {
            toastr()->error('Bạn không có quyền truy cập chức năng này!');
            return redirect('/admin/index');
        }




    }
}
