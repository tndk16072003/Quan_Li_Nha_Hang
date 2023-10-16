@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">
    <template v-for="(value, key) in list_ban" v-if="value.tinh_trang == 1">
    <div class="col-md-2">
        <div class="card">
            <div class="card-body text-center">
                <p v-if="value.trang_thai == 0" class="text-uppercase"><b>Bàn @{{ value.ten_ban }}</b></p>
                <p v-else-if="value.trang_thai == 1" class="text-uppercase text-primary"><b>Bàn @{{ value.ten_ban }}</b></p>
                <p v-else-if="value.trang_thai == 2" class="text-uppercase text-danger"><b>Bàn @{{ value.ten_ban }}</b></p>
                <i data-bs-toggle="modal" data-bs-target="#chiTietModal" v-on:click="openTable(value.id); getIdHoaDon(value.id)" v-if="value.trang_thai == 0" class="fa-solid fa-square-xmark fa-5x"></i>
                <i data-bs-toggle="modal" data-bs-target="#chiTietModal" v-else-if="value.trang_thai == 1" v-on:click="getIdHoaDon(value.id)" class="fa-solid fa-bowl-food fa-5x text-primary"></i>
                <i data-bs-toggle="modal" data-bs-target="#chiTietModal" v-else-if="value.trang_thai == 2" v-on:click="getIdHoaDon(value.id)" class="fa-solid fa-money-bill-wheat fa-5x text-warning"></i>
            </div>
            <div class="card-footer text-end">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <div v-if="value.trang_thai > 0" class="btn-group">
                        <button type="button" class="btn btn-outline-primary">Action</button>
                        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">	<span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="#">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Another action</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Separated link</a>
                            </li>
                        </ul>
                    </div>
                    <div v-else class="btn-group">
                        <button v-on:click="openTable(value.id)" type="button" class="btn btn-outline-secondary">Open !</button>
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">	<span class="visually-hidden">Toggle Dropdown</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </template>
    <div class="modal fade" id="chiTietModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 100%;">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Chi Tiết Bán Hàng @{{ add_mon.id_hoa_don_ban_hang }}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" v-on:click="trang_thai = 0"></button>
            </div>
            <div class="modal-body">
            <div class="row" v-if="trang_thai == 0">
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 700px">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="align-middle">Tìm kiếm</th>
                                            <th colspan="4">
                                                <input v-model="key_search" v-on:keyup.enter="search()" type="text" class="form-control">
                                            </th>
                                            <th class="text-center text-white">
                                                <button class="btn btn-info" v-on:click="search()">Tìm Kiếm</button>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="align-middle text-center">#</th>
                                            <th class="align-middle text-center">Tên Món</th>
                                            <th class="align-middle text-center" v-on:click="sort()">
                                                Đơn Giá
                                                <i v-if="order_by == 2" class="text-primary fa-solid fa-arrow-up"></i>
                                                <i v-else-if="order_by == 1" class="text-danger fa-solid fa-arrow-down"></i>
                                                <i v-else class="text-success fa-solid fa-spinner fa-pulse"></i>
                                            </th>
                                            <th class="align-middle text-center">ĐVT</th>
                                            <th class="align-middle text-center">Tên Danh Mục</th>
                                            <th class="align-middle text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(value, key) in list_mon">
                                            <tr>
                                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                                <td class="align-middle">@{{ value.ten_mon }}</td>
                                                <td class="align-middle">@{{ number_format(value.gia_ban) }}</td>
                                                <td class="align-middle">kg</td>
                                                <td class="align-middle">@{{ value.ten_danh_muc }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary" v-on:click="ChiTietBanHang(value.id)">Thêm Món</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="align-middle" colspan="3">
                                        <select v-if="hoa_don.is_xac_nhan == 0" class="form-control" v-model="hoa_don.id_khach_hang">
                                            <option value="0">Chọn tên khách hàng</option>
                                            <template v-for="(value, key) in list_khach">
                                            <option v-bind:value="value.id">@{{ value.ho_va_ten }}</option>
                                            </template>
                                        </select>
                                        <select v-else class="form-control" v-model="hoa_don.id_khach_hang" disabled>
                                            <option value="0">Chọn tên khách hàng</option>
                                            <template v-for="(value, key) in list_khach">
                                            <option v-bind:value="value.id">@{{ value.ho_va_ten }}</option>
                                            </template>
                                        </select>
                                    </th>
                                    <th class="align-middle text-nowrap text-center">
                                        <button v-if="hoa_don.is_xac_nhan == 1" class="btn btn-primary" disabled>Xác Nhận</button>
                                        <button v-else class="btn btn-primary" v-on:click="xacNhan()">Xác Nhận</button>
                                        {{-- <a href="/admin/khach-hang" class="btn btn-info" target="_blank">Thêm</a> --}}
                                    </th>
                                    <th class="text-center align-middle">Tổng Tiền</th>
                                    <td class="align-middle">
                                        <b>@{{ number_format(tong_tien) }}</b>
                                    </td>
                                    <td class="align-middle">
                                        <i class="text-capitalize">@{{ tien_chu }}</i>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tên Món</th>
                                    <th class="text-center">Số Lượng</th>
                                    <th class="text-center">Đơn Giá</th>
                                    <th class="text-center">Chiết Khấu</th>
                                    <th class="text-center">Thành Tiền</th>
                                    <th class="text-center">Ghi Chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in list_detail">
                                    <th class="text-center align-middle">
                                        <template v-if="value.is_in_bep">
                                            @{{ key + 1 }}
                                        </template>
                                        <template v-else>
                                            <i class="fa-solid fa-trash-can text-danger" v-on:click="destroy(value)"></i>
                                        </template>
                                    </th>
                                    <td class="align-middle">@{{ value.ten_mon_an }} - @{{ value.id }}</td>
                                    <template v-if="value.is_in_bep">
                                        <td class="align-middle text-center">
                                            @{{ value.so_luong_ban }}
                                        </td>
                                    </template>
                                    <template v-else>
                                        <td class="align-middle text-center" style="width: 15%;">
                                            <input v-on:change="update(value)" v-model="value.so_luong_ban" type="number" class="form-control text-center" step="0.1" min="0.1">
                                        </td>
                                    </template>
                                    <td class="align-middle text-end">@{{ number_format(value.don_gia_ban) }}</td>
                                    <td class="align-middle" style="width: 15%;">
                                        <input v-on:change="updateChietKhau(value)" v-model="value.tien_chiet_khau" type="number" class="form-control" min="0">
                                    </td>
                                    <td class="align-middle text-end">@{{ number_format(value.thanh_tien) }}</td>
                                    <td class="align-middle" style="width: 25%;">
                                        <input v-on:change="update(value)" v-model="value.ghi_chu" type="text" class="form-control">
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-center">Giảm giá</th>
                                    <td colspan="2">
                                        <input v-on:change="updateHoaDon()" v-model="giam_gia" type="text" class="form-control">
                                    </td>
                                    <th class="text-center">Thực trả</th>
                                    <th class="text-danger">
                                        @{{ number_format(thanh_tien) }}
                                    </th>
                                    <td>
                                        <i>@{{ tt_chu }}</i>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row" v-if="trang_thai == 1">
                <div class="col-5">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle">Chọn bàn</th>
                                <th>
                                    <select v-on:change="loadDanhSachMonTheoHoaDonChuyenBan(id_ban_nhan)" v-model="id_ban_nhan" class="form-control">
                                        <option value="0">Chọn bàn cần chuyển món</option>
                                        <template v-for="(value, key) in list_ban" v-if="value.tinh_trang == 1 && value.trang_thai != 0">
                                            <option v-if="value.id != add_mon.id_ban" v-bind:value="value.id">@{{ value.ten_ban }}</option>
                                        </template>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Món</th>
                                <th class="text-center">Số Lượng</th>
                                <th class="text-center">Ghi Chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in list_mon_2">
                                <th class="text-center">@{{ key + 1 }}</th>
                                <td>@{{ value.ten_mon_an }}</td>
                                <td class="text-center">@{{ value.so_luong_ban }}</td>
                                <td>@{{ value.ghi_chu }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-7">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tên Món</th>
                                    <th class="text-center">Số Lượng</th>
                                    <th class="text-center">Số Lượng Chuyển</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in list_detail">
                                    <th class="text-center align-middle">
                                        @{{ key + 1 }}
                                    </th>
                                    <td class="align-middle">@{{ value.ten_mon_an }} - @{{ value.id }}</td>
                                    <td class="align-middle text-center">
                                        @{{ value.so_luong_ban }}
                                    </td>
                                    <td class="align-middle" style="width: 15%;">
                                        <input v-model="value.so_luong_chuyen" type="number" class="form-control" min="0">
                                    </td>
                                    <td class="text-center">
                                        <button v-on:click="chuyenMon(value)" class="btn btn-primary">Chuyển</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button v-if="trang_thai == 0" v-on:click="trang_thai = 1" type="button" class="btn btn-danger">Chuyển Bàn</button>
                <button v-if="trang_thai == 1" v-on:click="trang_thai = 0" type="button" class="btn btn-danger">Xong Chuyển Bàn</button>
                <button v-on:click="inBep(add_mon.id_hoa_don_ban_hang)" type="button" class="btn btn-primary">In Bếp</button>
                <a target="_blank" v-bind:href="'/admin/ban-hang/in-bill/' + add_mon.id_hoa_don_ban_hang" class="btn btn-warning">In Bill</a>
                <button v-on:click="thanhToan()" type="button" class="btn btn-success">Thanh Toán</button>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        new Vue({
            el      :   '#app',
            data    :   {
                list_ban    :   [],
                list_mon    :   [],
                list_mon_2  :   [],
                list_detail :   [],
                key_search  :   '',
                order_by    :   0,
                add_mon     :   {'id_hoa_don_ban_hang'  :   0, 'id_ban' : 0},
                trang_thai  :   0,
                id_ban_nhan :   0,
                id_hd_nhan  :   0,
                list_khach  :   [],
                hoa_don     :   {},
                tong_tien   :   0,
                tien_chu    :   '',
                giam_gia    :   0,
                thanh_tien  :   0,
                tt_chu      :   '',
            },
            created()   {
                this.loadDanhSachBan();
                this.loadDanhSachMon();
                this.loadDanhSachKhach();
            },
            methods :   {
                updateHoaDon() {
                    var payload = {
                        'id'        :   this.add_mon.id_hoa_don_ban_hang,
                        'giam_gia'  :   this.giam_gia,
                    };
                    axios
                        .post('{{ Route("7") }}', payload)
                        .then((res) => {
                            if(res.data.status) {
                                this.loadDanhSachMonTheoHoaDon(this.add_mon.id_hoa_don_ban_hang);
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                thanhToan() {
                    axios
                        .post('{{ Route("6") }}', this.add_mon)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.loadDanhSachBan();
                                $('#chiTietModal').modal('toggle');
                                var link = '/admin/ban-hang/in-bill/' + this.add_mon.id_hoa_don_ban_hang;
                                window.open(link,'_blank');
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                xacNhan() {
                    axios
                        .post('{{ Route("5") }}', this.hoa_don)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.hoa_don = res.data.data;
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                loadDanhSachKhach() {
                    axios
                        .get('{{ Route("4") }}')
                        .then((res) => {
                            this.list_khach = res.data.data;
                        });
                },
                chuyenMon(v) {
                    v['id_hoa_don_nhan']    =   this.id_hd_nhan;
                    axios
                        .post('{{ Route("3") }}', v)
                        .then((res) => {
                            if(res.data.status) {
                                this.loadDanhSachMonTheoHoaDon(this.add_mon.id_hoa_don_ban_hang);
                                this.loadDanhSachMonTheoHoaDonChuyenBan(this.id_ban_nhan);
                                toastr.success(res.data.message);
                            } else {
                                toastr.error(res.data.message);
                            }
                        });
                },
                loadDanhSachMonTheoHoaDonChuyenBan(id_ban_nhan) {
                    var payload = {
                        'id_ban'   :   id_ban_nhan,
                    };

                    axios
                        .post('{{ Route("2") }}', payload)
                        .then((res) => {
                            if(res.data.status) {
                                this.list_mon_2    = res.data.data;
                                this.id_hd_nhan    = res.data.id_hd;
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                updateChietKhau(v) {
                    axios
                        .post('{{ Route("1") }}', v)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                            } else {
                                toastr.error(res.data.message);
                            }
                            this.loadDanhSachMonTheoHoaDon(v.id_hoa_don_ban_hang);
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                destroy(payload) {
                    axios
                        .post('/admin/ban-hang/xoa-chi-tiet', payload)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                            } else {
                                toastr.error(res.data.message);
                            }
                            this.loadDanhSachMonTheoHoaDon(payload.id_hoa_don_ban_hang);
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                inBep(id_hoa_don_ban_hang) {
                    var payload = {
                        'id_hoa_don_ban_hang'   : id_hoa_don_ban_hang
                    };
                    axios
                        .post('/admin/ban-hang/in-bep', payload)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                            } else {
                                toastr.error(res.data.message);
                            }
                            this.loadDanhSachMonTheoHoaDon(payload.id_hoa_don_ban_hang);
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                update(v) {
                    axios
                        .post('/admin/ban-hang/update', v)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                            } else {
                                toastr.error(res.data.message);
                            }
                            this.loadDanhSachMonTheoHoaDon(v.id_hoa_don_ban_hang);
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                loadDanhSachMonTheoHoaDon(id_hoa_don) {
                    var payload = {
                        'id_hoa_don_ban_hang'   :   id_hoa_don,
                    };

                    axios
                        .post('/admin/ban-hang/danh-sach-mon-theo-hoa-don', payload)
                        .then((res) => {
                            if(res.data.status) {
                                // toastr.success(res.data.message);
                                this.list_detail    = res.data.data;
                                this.tong_tien      = res.data.tong_tien;
                                this.tien_chu       = res.data.tien_chu;
                                this.thanh_tien     = res.data.thanh_tien;
                                this.tt_chu         = res.data.tt_chu;
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                ChiTietBanHang(id_mon) {
                    var payload = {
                        'id_mon'                :   id_mon,
                        'id_hoa_don_ban_hang'   :   this.add_mon.id_hoa_don_ban_hang,
                    };

                    axios
                        .post('/admin/ban-hang/them-mon-an', payload)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.loadDanhSachMonTheoHoaDon(this.add_mon.id_hoa_don_ban_hang);
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                getIdHoaDon(id_ban) {
                    var payload = {
                        'id_ban'    :   id_ban
                    };
                    axios
                        .post('/admin/ban-hang/find-id-by-idban', payload)
                        .then((res) => {
                            if(res.data.status) {
                                this.add_mon.id_hoa_don_ban_hang = res.data.id_hoa_don;
                                this.add_mon.id_ban              = id_ban;
                                this.hoa_don                     = res.data.hoa_don;
                                this.loadDanhSachMonTheoHoaDon(this.add_mon.id_hoa_don_ban_hang);
                            } else {
                                toastr.error("Hệ thống đang bị sự cố!");
                                this.loadDanhSachBan();
                                $('#chiTietModal').modal('toggle');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                sort() {
                    this.order_by = this.order_by + 1;
                    if(this.order_by > 2) {
                        this.order_by = 0;
                    }
                    // Quy ước : 1 tăng dần theo giá, 2 giảm dần theo giá, 0: tăng dần theo id
                    if(this.order_by == 1) {
                        this.list_mon = this.list_mon.sort(function(a, b) {
                            return a.gia_ban - b.gia_ban;
                        })
                    } else if(this.order_by == 2) {
                        this.list_mon = this.list_mon.sort(function(a, b) {
                            return b.gia_ban - a.gia_ban;
                        })
                    } else {
                        this.list_mon = this.list_mon.sort(function(a, b) {
                            return a.id - b.id;
                        })
                    }
                },
                search() {
                    var payload = {
                        'key_search'    :   this.key_search
                    }
                    axios
                        .post('/admin/mon-an/search', payload)
                        .then((res) => {
                            this.list_mon = res.data.list;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                loadDanhSachMon() {
                    axios
                        .get('/admin/mon-an/data')
                        .then((res) => {
                            this.list_mon = res.data.list;
                        });
                },
                loadDanhSachBan() {
                    axios
                        .get('/admin/ban/data')
                        .then((res) => {
                            this.list_ban = res.data.data;
                        });
                },
                openTable(id_ban) {
                    var payload = {
                        'id_ban'    :   id_ban,
                    };
                    axios
                        .post('/admin/ban-hang/tao-hoa-don', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Success");
                                this.loadDanhSachBan();
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                                this.loadDanhSachBan();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                number_format(number) {
                    return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
                },
            },
        });
    });
</script>
@endsection
