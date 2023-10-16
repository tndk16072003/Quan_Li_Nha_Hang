@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-5">
        <div class="card">
            <div class="card-header">
                Thêm Mới Loại Khách Hàng
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Tên Loại Khách</label>
                    <input v-model="add_loai_kh.ten_loai_khach" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phần Trăm Giảm</label>
                    <input v-model="add_loai_kh.phan_tram_giam" type="number" min="0" max="100" class="form-control">
                </div>
                <div class="mb-3">
                    <div class="table-responsive" style="max-height: 450px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="align-middle">Tìm kiếm</th>
                                    <th colspan="2">
                                        <input v-model="search_mon" v-on:keyup.enter="searchMon()" type="text" class="form-control">
                                    </th>
                                    <th class="text-center text-white">
                                        <button class="btn btn-info" v-on:click="searchMon()">Tìm Kiếm</button>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="align-middle text-center">#</th>
                                    <th class="align-middle text-center">Tên Món</th>
                                    <th class="align-middle text-center">
                                        Đơn Giá
                                        <i v-if="order_by == 2" class="text-primary fa-solid fa-arrow-up"></i>
                                        <i v-else-if="order_by == 1" class="text-danger fa-solid fa-arrow-down"></i>
                                        <i v-else class="text-success fa-solid fa-spinner fa-pulse"></i>
                                    </th>
                                    <th class="align-middle text-center">ĐVT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in list_mon">
                                    <tr>
                                        <th class="text-center align-middle">
                                            <input type="checkbox" v-model="value.check">
                                        </th>
                                        <td class="align-middle">@{{ value.ten_mon }}</td>
                                        <td class="align-middle">@{{ number_format(value.gia_ban) }}</td>
                                        <td class="align-middle">kg</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button id="add" v-on:click="addLoaiKhachHang()" class="btn btn-primary">Thêm Mới</button>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                Danh Sách Loại Khách Hàng
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Tìm kiếm</th>
                            <th colspan="3">
                                <input v-model="key_search" v-on:keyup.enter="search()" type="text" class="form-control">
                            </th>
                            <th class="text-center text-white">
                                <button class="btn btn-info" v-on:click="search()">Tìm Kiếm</button>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                <button class="btn btn-danger" v-on:click="Clear()">Xóa</button>
                            </th>
                            <th class="text-center">Tên Loại Khách Hàng</th>
                            <th class="text-center" v-on:click="sort()">
                                Phần Trăm
                                <i v-if="order_by == 2" class="text-primary fa-solid fa-arrow-up"></i>
                                <i v-else-if="order_by == 1" class="text-danger fa-solid fa-arrow-down"></i>
                                <i v-else class="text-success fa-solid fa-spinner fa-pulse"></i>
                            </th>
                            <th class="text-center">Món Ăn Tặng</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(value, key) in list">
                            <tr>
                                <th class="text-center align-middle">
                                    <input type="checkbox" v-model="value.check">
                                </th>
                                <td class="align-middle text-nowrap">@{{ value.ten_loai_khach }}</td>
                                <td class="align-middle text-center text-nowrap">@{{ value.phan_tram_giam }}</td>
                                <td class="align-middle">@{{ value.ten_mon }}</td>
                                <td class="align-middle text-center text-nowrap">
                                    <button v-on:click="edit_loai_kh = Object.assign({}, value)" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateModal">Cập Nhật</button>
                                    <button v-on:click="del_loai_kh = value" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Món Ăn</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Tên Loại Khách</label>
                                <input v-model="edit_loai_kh.ten_loai_khach" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phần Trăm Giảm</label>
                                <input v-model="edit_loai_kh.phan_tram_giam" type="number" min="0" max="100" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tặng Món An</label>
                                <input v-model="edit_loai_kh.list_mon_tang" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="accpectUpdate()" type="button" class="btn btn-warning">Xác Nhận</button>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Loại Khách Hàng</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-primary" role="alert">
                                Bạn có chắc chắn muốn xóa loại khách hàng: <b class="text-danger text-uppercase">@{{ del_loai_kh.ten_loai_khach }}</b> này không?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-danger" v-on:click="accpectDel()" data-bs-dismiss="modal">Xác Nhận</button>
                        </div>
                        </div>
                    </div>
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
            el      :       '#app',
            data    :       {
                list            :   [],
                add_loai_kh     :   {'phan_tram_giam' : 0},
                del_loai_kh     :   {},
                edit_loai_kh    :   {},
                key_search      :   '',
                search_mon      :   '',
                order_by        :   0,
                list_mon        :   [],
            },
            created()   {
                this.loadData();
                this.loadDanhSachMon();
            },
            methods :   {
                Clear() {
                    axios
                        .post('/admin/loai-khach-hang/delete-all', this.list)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
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
                addLoaiKhachHang() {
                    $("#add").prop('disabled', true);
                    var payload = {
                        'ten_loai_khach'    :   this.add_loai_kh.ten_loai_khach,
                        'phan_tram_giam'    :   this.add_loai_kh.phan_tram_giam,
                        'list_mon'          :   this.list_mon,
                    };
                    axios
                        .post('/admin/loai-khach-hang/create', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                this.add_loai_kh = {'ten_loai_khach' : '', 'phan_tram_giam' : 0, 'list_mon_tang' : ''};
                                this.loadDanhSachMon();
                                $("#add").removeAttr("disabled");
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            } else if (res.data.status == 2) {
                                toastr.warning(res.data.message, "Warning");
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })
                            $("#add").removeAttr("disabled");
                        });
                },
                searchMon() {
                    var payload = {
                        'key_search'    :   this.search_mon
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
                sort() {
                    this.order_by = this.order_by + 1;
                    if(this.order_by > 2) {
                        this.order_by = 0;
                    }
                    // Quy ước : 1 tăng dần theo giá, 2 giảm dần theo giá, 0: tăng dần theo id
                    if(this.order_by == 1) {
                        this.list = this.list.sort(function(a, b) {
                            return a.phan_tram_giam - b.phan_tram_giam;
                        })
                    } else if(this.order_by == 2) {
                        this.list = this.list.sort(function(a, b) {
                            return b.phan_tram_giam - a.phan_tram_giam;
                        })
                    } else {
                        this.list = this.list.sort(function(a, b) {
                            return a.id - b.id;
                        })
                    }
                },
                accpectUpdate() {
                    axios
                        .post('/admin/loai-khach-hang/update', this.edit_loai_kh)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                $('#updateModal').modal('hide');
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            })
                            $("#add").removeAttr("disabled");
                        });
                },
                accpectDel() {
                    axios
                        .post('/admin/loai-khach-hang/delete', this.del_loai_kh)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            } else if (res.data.status == 2) {
                                toastr.warning(res.data.message, "Warning");
                            }
                        });
                },

                loadData() {
                    axios
                        .get('/admin/loai-khach-hang/data')
                        .then((res) => {
                            this.list  =  res.data.list;
                        });
                },
                search() {
                    var payload = {
                        'key_search'    :   this.key_search
                    }
                    axios
                        .post('/admin/loai-khach-hang/search', payload)
                        .then((res) => {
                            this.list = res.data.list;
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
