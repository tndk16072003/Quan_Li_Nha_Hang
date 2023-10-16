<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoaDon\AddMonAnVaoHoaDonRequest;
use App\Http\Requests\HoaDon\CheckIdHoaDonBanHangRequest;
use App\Http\Requests\HoaDon\GetDanhSachMonTheoHoaDonRequest;
use App\Http\Requests\HoaDon\UpdateChiTietBanHangRequest;
use App\Models\Ban;
use App\Models\ChiTietBanHang;
use Illuminate\Http\Request;
use App\Models\HoaDonBanHang;
use App\Models\KhachHang;
use App\Models\MonAn;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPViet\NumberToWords\Transformer;

class HoaDonBanHangController extends Controller
{
    public function tinhTongDaBanTheoIdMonAn($id_mon_an)
    {
        $tong_ban   =  ChiTietBanHang::join('hoa_don_ban_hangs', 'id_hoa_don_ban_hang', 'hoa_don_ban_hangs.id')
                                     ->where('id_mon_an', $id_mon_an)
                                     ->where('hoa_don_ban_hangs.trang_thai', 1)
                                     ->sum('so_luong_ban');

        $monAn              =  MonAn::find($id_mon_an);
        $monAn->tong_xuat   =  $tong_ban;
        $monAn->save();
    }

    public function test()
    {
        // return view('admin.mail.quen_mat_khau');
        // SELECT khach_hangs.ma_khach, khach_hangs.ho_va_ten, SUM(hoa_don_ban_hangs.tong_tien) as tong_tien
        // FROM khach_hangs join hoa_don_ban_hangs on khach_hangs.id = hoa_don_ban_hangs.id_khach_hang
        // GROUP BY khach_hangs.ma_khach, khach_hangs.ho_va_ten
        // ORDER BY tong_tien desc
        // LIMIT 10
        // $data   = KhachHang::join('hoa_don_ban_hangs', 'khach_hangs.id', 'hoa_don_ban_hangs.id_khach_hang')
        //                    ->select('khach_hangs.ma_khach', 'khach_hangs.ho_va_ten', DB::raw('SUM(hoa_don_ban_hangs.tong_tien) as tong_tien'))
        //                    ->groupBy('khach_hangs.ma_khach', 'khach_hangs.ho_va_ten')
        //                    ->orderByDESC('tong_tien')
        //                    ->take(10)
        //                    ->get();

        // SELECT mon_ans.id, mon_ans.ten_mon, mon_ans.slug_mon, SUM(chi_tiet_ban_hangs.so_luong_ban) as tong_so_luong, COUNT(chi_tiet_ban_hangs.id) as tong_so_lan
        // FROM (mon_ans join chi_tiet_ban_hangs on mon_ans.id = chi_tiet_ban_hangs.id_mon_an) join hoa_don_ban_hangs on chi_tiet_ban_hangs.id_hoa_don_ban_hang = hoa_don_ban_hangs.id
        // GROUP BY mon_ans.id, mon_ans.ten_mon, mon_ans.slug_mon
        $data       =   MonAn::join('chi_tiet_ban_hangs', 'mon_ans.id', 'chi_tiet_ban_hangs.id_mon_an')
                             ->join('hoa_don_ban_hangs', 'chi_tiet_ban_hangs.id_hoa_don_ban_hang', 'hoa_don_ban_hangs.id')
                             ->select('mon_ans.id', 'mon_ans.ten_mon', 'mon_ans.slug_mon', DB::raw('SUM(chi_tiet_ban_hangs.so_luong_ban) as tong_so_luong'), DB::raw('COUNT(chi_tiet_ban_hangs.id) as tong_so_lan'))
                             ->groupBy('mon_ans.id', 'mon_ans.ten_mon', 'mon_ans.slug_mon')
                             ->having('tong_so_lan', '>=', 14)
                             ->get();
        dd($data->toArray());
    }

    public function getDanhSachMonTheoHoaDonDaThanhToan(Request $request)
    {
        $hoaDon     = HoaDonBanHang::find($request->id);
        if($hoaDon->trang_thai == 0) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này chưa tính tiền!',
            ]);
        } else {
            $data = ChiTietBanHang::where('id_hoa_don_ban_hang', $request->id)->get();
            $tong_tien  = 0;
            foreach($data as $key => $value) {
                $tong_tien += $value->thanh_tien;
            }
            $transformer = new Transformer();

            $giam_gia    = $hoaDon->giam_gia;
            $thanh_tien  = $tong_tien - $giam_gia;

            return response()->json([
                'status'        => 1,
                'data'          => $data,
                'tong_tien'     => $tong_tien,
                'tien_chu'      => $transformer->toCurrency($tong_tien),
                'thanh_tien'    => $thanh_tien,
                'tt_chu'        => $transformer->toCurrency($thanh_tien),
            ]);
        }
    }


    public function updateHoaDon(Request $request)
    {
        $hoaDonBanHang = HoaDonBanHang::find($request->id);
        if($hoaDonBanHang && $hoaDonBanHang->trang_thai == 0) {
            $hoaDonBanHang->giam_gia = $request->giam_gia;
            $hoaDonBanHang->save();

            return response()->json([
                'status'    => 1,
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        }
    }

    public function inBill($id)
    {
        $chiTiet = ChiTietBanHang::where('id_hoa_don_ban_hang', $id)->get();
        $tong_tien  = 0;
        foreach($chiTiet as $key => $value) {
            $tong_tien += $value->thanh_tien;
        }
        $transformer = new Transformer();
        $hoaDon      = HoaDonBanHang::find($id);

        $giam_gia    = $hoaDon->giam_gia;
        $thanh_tien  = $tong_tien - $giam_gia;
        $tt_chu      = $transformer->toCurrency($thanh_tien);
        $ngay        = $hoaDon->ngay_thanh_toan ? Carbon::parse($hoaDon->ngay_thanh_toan)->format('H:i d/m/Y')  : 'Hóa đơn tạm tính';

        return view('admin.page.ban_hang.in_bill', compact('chiTiet', 'tong_tien', 'thanh_tien', 'giam_gia', 'tt_chu', 'ngay'));
    }

    public function thanhToan(Request $request)
    {
        $hoaDonBanHang = HoaDonBanHang::find($request->id_hoa_don_ban_hang);
        if($hoaDonBanHang && $hoaDonBanHang->trang_thai == 0) {
            $data = ChiTietBanHang::where('id_hoa_don_ban_hang', $request->id_hoa_don_ban_hang)->get();
            $tong_tien  = 0;
            foreach($data as $key => $value) {
                $tong_tien += $value->thanh_tien;
                $this->tinhTongDaBanTheoIdMonAn($value->id_mon_an);
            }

            ChiTietBanHang::where('id_hoa_don_ban_hang', $request->id_hoa_don_ban_hang)
                          ->update([
                                'is_che_bien'    =>  1,
                                'is_tiep_thuc'   =>  1,
                                'is_in_bep'      =>  1,
                          ]);

            $hoaDonBanHang->trang_thai = 1;
            $hoaDonBanHang->ngay_thanh_toan = Carbon::now();
            $hoaDonBanHang->tong_tien       = $tong_tien - $hoaDonBanHang->tien_giam_gia;
            $hoaDonBanHang->save();

            $ban                =   Ban::find($request->id_ban);
            $ban->trang_thai    =   0;
            $ban->save();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thanh toán thành công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        }
    }

    public function xacNhanKhach(Request $request)
    {
        $hoaDonBanHang   = HoaDonBanHang::find($request->id);
        if($hoaDonBanHang && $hoaDonBanHang->trang_thai == 0) {
            if($hoaDonBanHang->is_xac_nhan == 0) {
                $hoaDonBanHang->id_khach_hang   = $request->id_khach_hang;
                $hoaDonBanHang->is_xac_nhan     = 1;
                $hoaDonBanHang->save();
                // Tiếp tục tặng món
            }
            return response()->json([
                'status'    => 1,
                'message'   => 'Đã xác nhận khách!',
                'data'      => $hoaDonBanHang,
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        }
    }

    public function InBep(CheckIdHoaDonBanHangRequest $request)
    {
        $hoaDonBanHang   = HoaDonBanHang::find($request->id_hoa_don_ban_hang);

        if($hoaDonBanHang && $hoaDonBanHang->trang_thai == 0) {
            ChiTietBanHang::where('id_hoa_don_ban_hang', $request->id_hoa_don_ban_hang)
                          ->update([
                            'is_in_bep'     => 1,
                          ]);
            return response()->json([
                'status'    => 1,
                'message'   => 'Đã in bếp thành công!',
            ]);

        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        }
    }

    public function getDanhSachMonTheoHoaDon(GetDanhSachMonTheoHoaDonRequest $request)
    {
        $hoaDon     = HoaDonBanHang::find($request->id_hoa_don_ban_hang);
        if($hoaDon->trang_thai) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        } else {
            $data = ChiTietBanHang::where('id_hoa_don_ban_hang', $request->id_hoa_don_ban_hang)->get();
            $tong_tien  = 0;
            foreach($data as $key => $value) {
                $tong_tien += $value->thanh_tien;
            }
            $transformer = new Transformer();

            $giam_gia    = $hoaDon->giam_gia;
            $thanh_tien  = $tong_tien - $giam_gia;

            return response()->json([
                'status'        => 1,
                'data'          => $data,
                'tong_tien'     => $tong_tien,
                'tien_chu'      => $transformer->toCurrency($tong_tien),
                'thanh_tien'    => $thanh_tien,
                'tt_chu'        => $transformer->toCurrency($thanh_tien),
            ]);
        }
    }

    public function addMonAnChiTietHoaDon(AddMonAnVaoHoaDonRequest $request)
    {
        $hoaDon     = HoaDonBanHang::find($request->id_hoa_don_ban_hang);
        if($hoaDon->trang_thai) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        } else {
            $monAn  = MonAn::find($request->id_mon);
            $check  = ChiTietBanHang::where('id_hoa_don_ban_hang', $request->id_hoa_don_ban_hang)
                                    ->where('id_mon_an', $request->id_mon)
                                    ->first();
            if($check && $check->is_in_bep == 0) {
                $check->so_luong_ban    = $check->so_luong_ban + 1;
                $check->thanh_tien      = $check->so_luong_ban * $check->don_gia_ban - $check->tien_chiet_khau;
                $check->save();
            } else {
                ChiTietBanHang::create([
                    'id_hoa_don_ban_hang'       =>  $request->id_hoa_don_ban_hang,
                    'id_mon_an'                 =>  $request->id_mon,
                    'ten_mon_an'                =>  $monAn->ten_mon,
                    'so_luong_ban'              =>  1,
                    'don_gia_ban'               =>  $monAn->gia_ban,
                    'tien_chiet_khau'           =>  0,
                    'thanh_tien'                =>  $monAn->gia_ban,
                ]);
            }

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thêm món thành công!',
            ]);
        }
    }

    public function index()
    {
        $x          = $this->checkRule(40);
        if($x)  {
            toastr()->error("Bạn không đủ quyền truy cập!");
            return redirect('/');
        }
        return view('admin.page.ban_hang.index');
    }

    public function store(Request $request)
    {
        $ban    = Ban::find($request->id_ban);
        if($ban && $ban->tinh_trang == 1 && $ban->trang_thai == 0) {
            $ban->trang_thai    = 1;    // lên màu xanh
            $ban->save();

            $hoaDon = HoaDonBanHang::create([
                'ma_hoa_don_ban_hang'       =>  Str::uuid(),
                'id_ban'                    =>  $request->id_ban,
            ]);

            return response()->json([
                'status'                    => true,
                'message'                   => 'Đã mở bàn!',
            ]);
        } else {
            return response()->json([
                'status'                    => false,
                'message'                   => 'Bàn không thể mở!',
            ]);
        }
    }

    public function findIdByIdBan(Request $request)
    {
        // Hóa đơn bán hàng mà chưa tính tiền => trạng thái = 0
        $hoaDon =  HoaDonBanHang::where('id_ban', $request->id_ban)
                                ->where('trang_thai', 0)
                                ->first();

        if($hoaDon) {
            return response()->json([
                'status'        => true,
                'id_hoa_don'    => $hoaDon->id,
                'hoa_don'       => $hoaDon,
            ]);
        } else {
            return response()->json([
                'status'        => false,
                'id_hoa_don'    => 0,
            ]);
        }
    }

    public function update(UpdateChiTietBanHangRequest $request)
    {
        $chiTietBanHang  = ChiTietBanHang::find($request->id);
        $hoaDonBanHang   = HoaDonBanHang::find($request->id_hoa_don_ban_hang);

        if($hoaDonBanHang && $hoaDonBanHang->trang_thai == 0 && $chiTietBanHang->is_in_bep == 0) {
            $chiTietBanHang->so_luong_ban       = $request->so_luong_ban;
            $chiTietBanHang->thanh_tien         = $chiTietBanHang->so_luong_ban * $request->don_gia_ban;
            $chiTietBanHang->ghi_chu            = $request->ghi_chu;
            $chiTietBanHang->tien_chiet_khau    = $request->tien_chiet_khau;

            if($request->tien_chiet_khau > $chiTietBanHang->thanh_tien) {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tiền chiết khấu chỉ được tối đa: ' . number_format($chiTietBanHang->thanh_tien, 0 , '.', '.') . 'đ',
                ]);
            } else {
                $chiTietBanHang->thanh_tien = $chiTietBanHang->thanh_tien - $request->tien_chiet_khau;
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

    public function XoaChiTietDonHang(UpdateChiTietBanHangRequest $request)
    {
        $chiTietBanHang  = ChiTietBanHang::find($request->id);
        $hoaDonBanHang   = HoaDonBanHang::find($request->id_hoa_don_ban_hang);

        if($hoaDonBanHang && $hoaDonBanHang->trang_thai == 0 && $chiTietBanHang->is_in_bep == 0) {
            $chiTietBanHang->delete();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã xóa sản phẩm lượng!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Có lỗi không mong muốn xảy ra!',
            ]);
        }
    }
}
