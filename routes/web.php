<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BanController;
use App\Http\Controllers\ChiTietBanHangController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\HoaDonBanHangController;
use App\Http\Controllers\HoaDonNhapHangController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\KhuVucController;
use App\Http\Controllers\LoaiKhachHangController;
use App\Http\Controllers\MonAnController;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\QuyenController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ThongKeController;
use App\Models\DanhMuc;
use App\Models\HoaDonBanHang;
use App\Models\HoaDonNhapHang;
use Illuminate\Support\Facades\Route;
use NumberToWords\Legacy\Numbers\Words\Locale\Ro;

// Route::get('/', [TestController::class, 'index']);
// Route::get('/test', [HoaDonBanHangController::class, 'test']);

Route::get('/', [AdminController::class, 'viewLogin']);
Route::post('/admin/login', [AdminController::class, 'actionLogin']);

Route::get('/admin/lost-password', [AdminController::class, 'viewLostPass']);
Route::post('/admin/lost-password', [AdminController::class, 'actionLostPass']);

Route::get('/admin/update-password/{hash_reset}', [AdminController::class, 'viewUpdatePass']);
Route::post('/admin/update-password', [AdminController::class, 'actionUpdatePass']);
Route::get('/test', [AdminController::class, 'testMail']);

Route::group(['prefix' => '/admin', "middleware" => "checkAdminLogin"], function() {
    Route::get('/logout', [AdminController::class, 'actionLogout']);
    // Code của khu vực
    Route::group(['prefix' => '/khu-vuc'], function() {
        Route::get('/', [KhuVucController::class, 'index']);
        Route::get('/vue', [KhuVucController::class, 'index_vue']);
        Route::get('/data', [KhuVucController::class, 'getData']);
        Route::post('/doi-trang-thai', [KhuVucController::class, 'doiTrangThai']);
        Route::post('/delete', [KhuVucController::class, 'destroy']);
        Route::post('/delete-all', [KhuVucController::class, 'destroyAll'])->name('deleteAll');
        Route::post('/edit', [KhuVucController::class, 'edit']);
        Route::post('/create', [KhuVucController::class, 'store']);
        Route::post('/check-slug', [KhuVucController::class, 'checkSlug']);
        Route::post('/update', [KhuVucController::class, 'update']);
    });

    Route::group(['prefix' => '/ban'], function() {
        Route::get('/', [BanController::class, 'index']);
        Route::get('/vue', [BanController::class, 'index_vue']);
        Route::get('/data', [BanController::class, 'getData']);
        Route::post('/doi-trang-thai', [BanController::class, 'doiTrangThai']);
        Route::post('/delete', [BanController::class, 'destroy']);
        Route::post('/edit', [BanController::class, 'edit']);
        Route::post('/create', [BanController::class, 'store']);
        Route::post('/check-slug', [BanController::class, 'checkSlug']);
        Route::post('/update', [BanController::class, 'update']);
        Route::post('/delete-all', [BanController::class, 'deleteCheckbox']);
    });

    Route::group(['prefix' => '/danh-muc'], function() {
        Route::get('/', [DanhMucController::class, 'index']);
        Route::get('/vue', [DanhMucController::class, 'index_vue']);
        Route::get('/data', [DanhMucController::class, 'getData']);
        Route::post('/doi-trang-thai', [DanhMucController::class, 'doiTrangThai']);
        Route::post('/delete', [DanhMucController::class, 'destroy']);
        Route::post('/edit', [DanhMucController::class, 'edit']);
        Route::post('/create', [DanhMucController::class, 'store']);
        Route::post('/update', [DanhMucController::class, 'update']);
        Route::post('/delete-all', [DanhMucController::class, 'deleteCheckbox']);
    });

    Route::group(['prefix' => '/mon-an'], function() {
        Route::get('/', [MonAnController::class, 'index']);
        Route::get('/vue', [MonAnController::class, 'index_vue']);
        Route::get('/data', [MonAnController::class, 'getData']);
        Route::post('/doi-trang-thai', [MonAnController::class, 'doiTrangThai']);
        Route::post('/delete', [MonAnController::class, 'destroy']);
        Route::post('/edit', [MonAnController::class, 'edit']);
        Route::post('/create', [MonAnController::class, 'store']);
        Route::post('/check-slug', [MonAnController::class, 'checkSlug']);
        Route::post('/update', [MonAnController::class, 'update']);
        Route::post('/search', [MonAnController::class, 'search']);
        Route::post('/delete-all', [MonAnController::class, 'deleteCheckbox']);
    });

    // Bán hàng
    Route::group(['prefix' => '/ban-hang'], function() {
        Route::get('/', [HoaDonBanHangController::class, 'index']);
        Route::post('/tao-hoa-don', [HoaDonBanHangController::class, 'store']);
        Route::post('/find-id-by-idban', [HoaDonBanHangController::class, 'findIdByIdBan']);
        Route::post('/them-mon-an', [HoaDonBanHangController::class, 'addMonAnChiTietHoaDon']);
        Route::post('/danh-sach-mon-theo-hoa-don', [HoaDonBanHangController::class, 'getDanhSachMonTheoHoaDon']);
        Route::post('/update', [HoaDonBanHangController::class, 'update']);
        Route::post('/in-bep', [HoaDonBanHangController::class, 'InBep']);
        Route::post('/xoa-chi-tiet', [HoaDonBanHangController::class, 'XoaChiTietDonHang']);
        Route::post('/chi-tiet/update-chiet-khau', [ChiTietBanHangController::class, 'UpdateChietKhau'])->name('1');
        Route::post('/danh-sach-mon-theo-id-ban', [ChiTietBanHangController::class, 'getDanhSachMonTheoIdBan'])->name('2');
        Route::post('/chuyen-mon', [ChiTietBanHangController::class, 'chuyenMonQuaBanKhac'])->name('3');
        Route::post('/xac-nhan', [HoaDonBanHangController::class, 'xacNhanKhach'])->name('5');
        Route::post('/thanh-toan', [HoaDonBanHangController::class, 'thanhToan'])->name('6');
        Route::get('/in-bill/{id}', [HoaDonBanHangController::class, 'inBill']);
        Route::post('/update-hoa-don', [HoaDonBanHangController::class, 'updateHoaDon'])->name('7');
    });

    // Khách hàng
    Route::group(['prefix' => '/khach-hang'], function() {
        Route::get('/', [KhachHangController::class, 'index']);
        Route::post('/create', [KhachHangController::class, 'store']);
        Route::post('/update', [KhachHangController::class, 'update']);
        Route::post('/delete', [KhachHangController::class, 'delete']);
        Route::post('/search', [KhachHangController::class, 'search']);
        Route::get('/data', [KhachHangController::class, 'getData'])->name('4');
        Route::post('/delete-all', [KhachHangController::class, 'deleteCheckbox']);
    });

    // Loại Khách hàng
    Route::group(['prefix' => '/loai-khach-hang'], function() {
        Route::get('/', [LoaiKhachHangController::class, 'index']);
        Route::get('/data', [LoaiKhachHangController::class, 'getData']);
        Route::post('/delete', [LoaiKhachHangController::class, 'destroy']);
        Route::post('/create', [LoaiKhachHangController::class, 'store']);
        Route::post('/update', [LoaiKhachHangController::class, 'update']);
        Route::post('/search', [LoaiKhachHangController::class, 'search']);
        Route::post('/delete-all', [LoaiKhachHangController::class, 'deleteCheckbox']);
    });

    // MENU BẾP
    Route::group(['prefix' => '/bep'], function() {
        Route::get('/', [ChiTietBanHangController::class, 'indexBep']);
        Route::get('/data-bep', [ChiTietBanHangController::class, 'getDataBep']);
        Route::post('/update-bep', [ChiTietBanHangController::class, 'updateBep']);
        Route::post('/update-all', [ChiTietBanHangController::class, 'UpdateCheckBox']);

    });

    // MENU TIẾP THỰC
    Route::group(['prefix' => '/tiep-thuc'], function() {
        Route::get('/', [ChiTietBanHangController::class, 'indexTiepThuc']);
        Route::get('/data-tiep-thuc', [ChiTietBanHangController::class, 'getDataTiepThuc']);
        Route::post('/update-tiep-thuc', [ChiTietBanHangController::class, 'updateTiepThuc']);
        Route::post('/update-all', [ChiTietBanHangController::class, 'UpdateCheckBoxTT']);

    });
    Route::group(['prefix' => '/nha-cung-cap'], function() {
        Route::get('/index', [NhaCungCapController::class, 'index']);
        Route::post('/create', [NhaCungCapController::class, 'store']);
        Route::get('/data', [NhaCungCapController::class, 'data']);
        Route::post('/delete', [NhaCungCapController::class, 'destroy']);
        Route::post('/update', [NhaCungCapController::class, 'update']);
        Route::post('/doi-trang-thai', [NhaCungCapController::class, 'doiTrangThai']);


    });
    Route::group(['prefix' => '/nhap-hang'],function(){
        Route::get('/',[HoaDonNhapHangController::class,'index']);
        Route::get('/data',[HoaDonNhapHangController::class,'getData']);

        Route::post('/add-san-pham-nhap-hang', [HoaDonNhapHangController::class, 'addSanPhamNhapHang']);
        Route::post('/delete-mon-an', [HoaDonNhapHangController::class, 'deleteMonAnNhapHang']);
        Route::post('/update-chi-tiet-hoa-don-nhap', [HoaDonNhapHangController::class, 'updateChiTietHoaDonNhap']);
        Route::post('/nhap-hang-real', [HoaDonNhapHangController::class, 'nhapHangReal']);
        Route::post('/gui-mail', [HoaDonNhapHangController::class, 'guiMail']);
    });

    Route::group(['prefix' => '/thong-ke'],function(){
        Route::get('/ban-hang',[ThongKeController::class,'viewThongKeBanHang']);
        Route::post('/ban-hang', [ThongKeController::class, 'actionThongKeBanHang'])->name('8');
        Route::post('/danh-sach-mon-theo-hoa-don-da-thanh-toan', [HoaDonBanHangController::class, 'getDanhSachMonTheoHoaDonDaThanhToan'])->name('9');

        Route::get('/mon-an',[ThongKeController::class,'viewThongKeMonAn']);
        Route::post('/mon-an', [ThongKeController::class, 'actionThongKeMonAn'])->name('10');
        Route::post('/chi-tiet-mon-an', [ThongKeController::class, 'actionChiTietMonAn'])->name('11');

        Route::get('/chart', [ThongKeController::class, 'indexChart']);
        Route::post('/chart', [ThongKeController::class, 'thongKeChart']);

        Route::get('/chart-js', [ThongKeController::class, 'indexChartJS']);
        Route::post('/chart-js', [ThongKeController::class, 'thongKeChartJS'])->name("thongKe");

    });

    Route::group(['prefix' => '/tai-khoan'],function(){
        Route::get('/index',[AdminController::class,'index']);

        Route::post('/create',[AdminController::class,'store']);
        Route::get('/data', [AdminController::class, 'getData']);
        Route::post('/delete', [AdminController::class, 'destroy']);
        Route::post('/update', [AdminController::class, 'update']);
        Route::post('/change-password', [AdminController::class, 'changePassword']);
    });

    Route::group(['prefix' => '/quyen'], function() {
        Route::get('/', [QuyenController::class, 'index']);
        Route::get('/data', [QuyenController::class, 'getData']);
        Route::get('/data-quyen', [QuyenController::class, 'getDataQuyen']);
        Route::post('/delete', [QuyenController::class, 'destroy']);
        Route::post('/create', [QuyenController::class, 'store']);
        Route::post('/update', [QuyenController::class, 'update']);
        Route::post('/search', [QuyenController::class, 'search']);
        Route::post('/delete-all', [QuyenController::class, 'deleteCheckbox']);
        Route::post('/phan-quyen', [QuyenController::class, 'phanQuyen']);
    });

});
