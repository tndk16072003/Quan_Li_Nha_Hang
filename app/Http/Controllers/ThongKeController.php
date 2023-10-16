<?php

namespace App\Http\Controllers;

use App\Models\ChiTietBanHang;
use App\Models\HoaDonBanHang;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function viewThongKeBanHang()
    {
        return view('admin.page.thong_ke.ban_hang');
    }

    public function actionThongKeBanHang(Request $request)
    {
        $data   = HoaDonBanHang::where('trang_thai', 1)
                               ->whereDate('ngay_thanh_toan', '>=', $request->begin)
                               ->whereDate('ngay_thanh_toan', '<=', $request->end)
                               ->get();
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã lấy dữ liệu',
            'data'      => $data,
        ]);
    }

    public function viewThongKeMonAn()
    {
        return view('admin.page.thong_ke.mon_an');
    }

    public function actionThongKeMonAn(Request $request)
    {
        $data = ChiTietBanHang::join('hoa_don_ban_hangs', 'hoa_don_ban_hangs.id', 'chi_tiet_ban_hangs.id_hoa_don_ban_hang')
                              ->whereDate('hoa_don_ban_hangs.ngay_thanh_toan', '>=', $request->begin)
                              ->whereDate('hoa_don_ban_hangs.ngay_thanh_toan', '<=', $request->end)
                              ->where('hoa_don_ban_hangs.trang_thai', 1)
                              ->select('chi_tiet_ban_hangs.ten_mon_an',
                                       'chi_tiet_ban_hangs.id_mon_an',
                                        DB::raw('SUM(chi_tiet_ban_hangs.so_luong_ban) as tong_so_luong_ban'),
                                        DB::raw('SUM(chi_tiet_ban_hangs.thanh_tien) as tong_tien_thanh_toan')
                                    )
                              ->groupBy('chi_tiet_ban_hangs.ten_mon_an',
                                            'chi_tiet_ban_hangs.id_mon_an')
                              ->get();
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã lấy dữ liệu',
            'data'      => $data,
        ]);
    }

    public function actionChiTietMonAn(Request $request)
    {
        $data = ChiTietBanHang::where('id_mon_an', $request->id_mon_an)
                              ->join('hoa_don_ban_hangs', 'hoa_don_ban_hangs.id', 'chi_tiet_ban_hangs.id_hoa_don_ban_hang')
                              ->where('hoa_don_ban_hangs.trang_thai', 1)
                              ->whereDate('hoa_don_ban_hangs.ngay_thanh_toan', '>=', $request->begin)
                              ->whereDate('hoa_don_ban_hangs.ngay_thanh_toan', '<=', $request->end)
                              ->join('bans', 'bans.id', 'hoa_don_ban_hangs.id_ban')
                              ->join('khu_vucs', 'khu_vucs.id', 'bans.id_khu_vuc')
                              ->select('bans.ten_ban', 'khu_vucs.ten_khu',
                                        DB::raw('SUM(chi_tiet_ban_hangs.so_luong_ban) as tong_so_luong'),
                                        DB::raw('SUM(chi_tiet_ban_hangs.thanh_tien) as tong_tien_thanh_toan'),
                                    )
                              ->groupBy('bans.ten_ban', 'khu_vucs.ten_khu')
                              ->get();
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã lấy dữ liệu',
            'data'      => $data,
        ]);
    }

    public function indexChart()
    {
        $data   = KhachHang::join('hoa_don_ban_hangs', 'khach_hangs.id', 'hoa_don_ban_hangs.id_khach_hang')
                           ->select('khach_hangs.ma_khach', 'khach_hangs.ho_va_ten', DB::raw('SUM(hoa_don_ban_hangs.tong_tien) as tong_tien'))
                           ->groupBy('khach_hangs.ma_khach', 'khach_hangs.ho_va_ten')
                           ->orderByDESC('tong_tien')
                           ->take(10)
                           ->get();
        $list_ten = [];
        $list_tien = [];
        foreach($data as $key => $value) {
            array_push($list_ten, $value->ho_va_ten);
            array_push($list_tien, $value->tong_tien);
        }

        return view('admin.page.thong_ke.chart', compact('list_ten', 'list_tien'));
    }

    public function thongKeChart(Request $request)
    {
        $data   = KhachHang::join('hoa_don_ban_hangs', 'khach_hangs.id', 'hoa_don_ban_hangs.id_khach_hang')
                           ->whereDate('hoa_don_ban_hangs.ngay_thanh_toan', '>=', $request->begin)
                           ->whereDate('hoa_don_ban_hangs.ngay_thanh_toan', '<=', $request->end)
                           ->select('khach_hangs.ma_khach', 'khach_hangs.ho_va_ten', DB::raw('SUM(hoa_don_ban_hangs.tong_tien) as tong_tien'))
                           ->groupBy('khach_hangs.ma_khach', 'khach_hangs.ho_va_ten')
                           ->orderByDESC('tong_tien')
                           ->take(7)
                           ->get();
        $list_ten = [];
        $list_tien = [];
        foreach($data as $key => $value) {
            array_push($list_ten, $value->ho_va_ten);
            array_push($list_tien, $value->tong_tien);
        }

        return view('admin.page.thong_ke.chart', compact('list_ten', 'list_tien'));
    }

    public function indexChartJS()
    {
        return view('admin.page.thong_ke.chart_js');
    }

    public function thongKeChartJS(Request $request)
    {
        $data   = KhachHang::join('hoa_don_ban_hangs', 'khach_hangs.id', 'hoa_don_ban_hangs.id_khach_hang')
                            ->whereDate('hoa_don_ban_hangs.ngay_thanh_toan', '>=', $request->begin)
                            ->whereDate('hoa_don_ban_hangs.ngay_thanh_toan', '<=', $request->end)
                            ->select('khach_hangs.ma_khach', 'khach_hangs.ho_va_ten', DB::raw('SUM(hoa_don_ban_hangs.tong_tien) as tong_tien'))
                            ->groupBy('khach_hangs.ma_khach', 'khach_hangs.ho_va_ten')
                            ->orderByDESC('tong_tien')
                            ->take(10)
                            ->get();
        $list_ten = [];
        $list_tien = [];
        foreach($data as $key => $value) {
            array_push($list_ten, $value->ho_va_ten);
            array_push($list_tien, $value->tong_tien);
        }

        return response()->json([
            "list_ten"  => $list_ten,
            "list_tien" => $list_tien,
        ]);
    }
}
