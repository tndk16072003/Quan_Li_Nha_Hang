<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoaDon\UpdateChiTietBanHangRequest;
use App\Models\ChiTietBanHang;
use App\Models\HoaDonBanHang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ChiTietBanHangController extends Controller
{
    public function chuyenMonQuaBanKhac(Request $request)
    {
        $so_luong_chuyen    =   $request->so_luong_chuyen;
        $id_hoa_don_nhan    =   $request->id_hoa_don_nhan;

        $hoaDon = HoaDonBanHang::find($request->id_hoa_don_ban_hang);

        if($hoaDon && $hoaDon->trang_thai == 0) {
            // Trường hợp a
            if($so_luong_chuyen > 0 && $so_luong_chuyen == $request->so_luong_ban) {
                $chiTietBanHang                         = ChiTietBanHang::find($request->id);
                $chiTietBanHang->id_hoa_don_ban_hang    = $id_hoa_don_nhan;
                $dau_cach                               =  $chiTietBanHang->ghi_chu ? ": " : '';
                $chiTietBanHang->ghi_chu                =  'Chuyển món từ hóa đơn ' . $chiTietBanHang->id_hoa_don_ban_hang . ' sang' . $dau_cach .  $chiTietBanHang->ghi_chu;
                $chiTietBanHang->save();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã chuyển món thành công!',
                ]);
            } else if($so_luong_chuyen > 0 && $so_luong_chuyen < $request->so_luong_ban) {
                $chiTietBanHang                         = ChiTietBanHang::find($request->id);

                $don_gia                                = $chiTietBanHang->don_gia_ban;
                $tien_giam_gia_1_phan                   = $chiTietBanHang->tien_chiet_khau / $chiTietBanHang->so_luong_ban;

                $chiTietBanHang->so_luong_ban          -= $so_luong_chuyen;
                $tien_chiet_khau                        = $tien_giam_gia_1_phan * $chiTietBanHang->so_luong_ban;
                $chiTietBanHang->thanh_tien             = $chiTietBanHang->so_luong_ban * $don_gia - $tien_chiet_khau;
                $chiTietBanHang->tien_chiet_khau        = $tien_chiet_khau;
                $chiTietBanHang->save();

                $dau_cach       =  $chiTietBanHang->ghi_chu ? ": " : '';

                ChiTietBanHang::create([
                    'id_hoa_don_ban_hang'       =>  $id_hoa_don_nhan,
                    'id_mon_an'                 =>  $chiTietBanHang->id_mon_an,
                    'ten_mon_an'                =>  $chiTietBanHang->ten_mon_an,
                    'so_luong_ban'              =>  $so_luong_chuyen,
                    'don_gia_ban'               =>  $chiTietBanHang->don_gia_ban,
                    'tien_chiet_khau'           =>  $tien_giam_gia_1_phan * $so_luong_chuyen,
                    'thanh_tien'                =>  $so_luong_chuyen * $chiTietBanHang->don_gia_ban - $tien_giam_gia_1_phan * $so_luong_chuyen,
                    'ghi_chu'                   =>  'Chuyển món từ hóa đơn ' . $chiTietBanHang->id_hoa_don_ban_hang . ' sang' . $dau_cach .  $chiTietBanHang->ghi_chu,
                    'is_che_bien'               =>  $chiTietBanHang->is_che_bien,
                    'is_tiep_thuc'              =>  $chiTietBanHang->is_tiep_thuc,
                    'is_in_bep'                 =>  $chiTietBanHang->is_in_bep,
                ]);

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã chuyển món thành công!',
                ]);

            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Dữ liệu không chính xác!',
                ]);
            }

        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        }
    }

    public function indexBep()
    {
        $x          = $this->checkRule(22);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        return view('admin.page.bep.index');
    }

    public function indexTiepThuc()
    {
        $x          = $this->checkRule(18);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        return view('admin.page.tiep_thuc.index');
    }

    public function getDataBep()
    {
        $x          = $this->checkRule(23);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        $data = ChiTietBanHang::where('is_in_bep', 1)
                              ->where('is_che_bien', 0)
                              ->join('hoa_don_ban_hangs','chi_tiet_ban_hangs.id_hoa_don_ban_hang','hoa_don_ban_hangs.id')
                              ->join('bans','hoa_don_ban_hangs.id_ban','bans.id')
                              ->select('chi_tiet_ban_hangs.*','bans.ten_ban')
                              ->get();
        return response()->json([
            'status'    => 1,
            'data'   => $data,
        ]);
    }

    public function getDataTiepThuc()
    {
        $x          = $this->checkRule(19);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        $data = ChiTietBanHang::where('is_in_bep', 1)
                              ->where('is_che_bien', 1)
                              ->where('is_tiep_thuc', 0)
                              ->join('hoa_don_ban_hangs','chi_tiet_ban_hangs.id_hoa_don_ban_hang','hoa_don_ban_hangs.id')
                              ->join('bans','hoa_don_ban_hangs.id_ban','bans.id')
                              ->select('chi_tiet_ban_hangs.*','bans.ten_ban')
                              ->get();
        return response()->json([
            'status'    => 1,
            'data'   => $data,
        ]);
    }

    public function updateBep(Request $request)
    {
        $x          = $this->checkRule(24);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $check = ChiTietBanHang::find($request->id);

        if($check && $check->is_che_bien == 0) {
            $check->is_che_bien         = 1;
            $check->thoi_gian_che_bien  = strtotime(Carbon::now()) - strtotime($check->created_at);
            $check->save();

            return response()->json([
                'status'    => true,
                'message'   => 'Đã hoàn thành món ăn',
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Hệ thống đã có sự cố',
            ]);
        }
    }

    public function updateTiepThuc(Request $request)
    {
        $x          = $this->checkRule(20);
        if($x)  {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn không đủ quyền',
            ]);
        }
        $check = ChiTietBanHang::find($request->id);

        if($check && $check->is_che_bien == 1 && $check->is_tiep_thuc == 0) {
            $check->is_tiep_thuc = 1;
            $check->save();

            return response()->json([
                'status'    => true,
                'message'   => 'Đã tiếp thực món ăn',
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Hệ thống đã có sự cố',
            ]);
        }
    }

    public function UpdateChietKhau(UpdateChiTietBanHangRequest $request)
    {
        $chiTietBanHang  = ChiTietBanHang::find($request->id);
        $hoaDonBanHang   = HoaDonBanHang::find($request->id_hoa_don_ban_hang);

        if($hoaDonBanHang && $hoaDonBanHang->trang_thai == 0) {
            $thanh_tien                         = $chiTietBanHang->so_luong_ban * $chiTietBanHang->don_gia_ban;
            $chiTietBanHang->tien_chiet_khau    = $request->tien_chiet_khau;

            if($request->tien_chiet_khau > $thanh_tien) {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tiền chiết khấu chỉ được tối đa: ' . number_format($thanh_tien, 0 , '.', '.') . 'đ',
                ]);
            } else {
                $chiTietBanHang->thanh_tien = $thanh_tien - $request->tien_chiet_khau;
                $chiTietBanHang->save();

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật số lượng!',
                ]);
            }
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Có lỗi không mong muốn xảy ra!',
            ]);
        }
    }

    public function getDanhSachMonTheoIdBan(Request $request)
    {
        // B1: Tìm hóa đơn mà có bàn id = 7 đang hoạt động
        $hoaDon     = HoaDonBanHang::where('id_ban', $request->id_ban)->where('trang_thai', 0)->first();
        if($hoaDon) {
            $data   = ChiTietBanHang::where('id_hoa_don_ban_hang', $hoaDon->id)->get();

            return response()->json([
                'status'    => 1,
                'data'      => $data,
                'id_hd'     => $hoaDon->id,
            ]);

        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        }
    }
    public function UpdateCheckBox(Request $request)
    {
        $x          = $this->checkRule(25);
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
        }
        $data_id = explode("," , rtrim($str, ","));

        foreach ($data_id as $k => $v) {
            $Bep = ChiTietBanHang::where('id', $v)->first();

            if($Bep && $Bep->is_che_bien == 0) {
                $Bep->is_che_bien         = 1;
                $Bep->thoi_gian_che_bien  = strtotime(Carbon::now()) - strtotime($Bep->created_at);
                $Bep->save();
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Hệ thống đã có sự cố',
                ]);
            }
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Đã hoàn thành món ăn!',
        ]);
    }
    public function UpdateCheckBoxTT(Request $request)
    {
        $x          = $this->checkRule(21);
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
        }
        $data_id = explode("," , rtrim($str, ","));

        foreach ($data_id as $k => $v) {
            $TiepThuc = ChiTietBanHang::where('id', $v)->first();

            if($TiepThuc && $TiepThuc->is_che_bien == 1 && $TiepThuc->is_tiep_thuc == 0) {
                $TiepThuc->is_tiep_thuc = 1;
                $TiepThuc->save();
            }
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Đã hoàn thành món ăn!',
        ]);
    }

}
