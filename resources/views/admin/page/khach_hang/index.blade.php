@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <b>Thêm Mới Khách Hàng</b>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Họ Lót</label>
                    <input v-model="add_kh.ho_lot" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tên Khách</label>
                    <input v-model="add_kh.ten_khach" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Số Điện Thoại</label>
                    <input v-model="add_kh.so_dien_thoai" type="number" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input v-model="add_kh.email" type="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ghi chú</label>
                    <input v-model="add_kh.ghi_chu" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ngày Sinh</label>
                    <input v-model="add_kh.ngay_sinh" type="date" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Loại Khách</label>
                    <select v-model="add_kh.id_loai_khach" class="form-control">
                        <option value="0">Mời bạn chọn</option>
                        @foreach ($loaiKH as $key => $value )
                            <option value="{{$value->id}}">{{$value->ten_loai_khach}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mã số thuế</label>
                    <input v-model="add_kh.ma_so_thue" type="text" class="form-control">
                </div>
            </div>
            <div class="card-footer text-end">
                <button id="add" v-on:click="addKhachHang()" class="btn btn-primary">Thêm Mới</button>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                Danh Sách Khách Hàng
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle text-center">Tìm kiếm</th>
                                <th colspan="2">
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
                                <th class="text-center align-middle text-nowrap">Họ Và Tên</th>
                                <th class="text-center align-middle text-nowrap">Số Điện Thoại</th>
                                <th class="text-center align-middle text-nowrap">Email</th>
                                <th class="text-center align-middle text-nowrap">Ghi Chú</th>
                                <th class="text-center align-middle text-nowrap">Ngày Sinh</th>
                                <th class="text-center align-middle text-nowrap">Loại Khách</th>
                                <th class="text-center align-middle text-nowrap">Mã Số Thuế</th>
                                <th class="text-center align-middle text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list_khach_hang">
                                <tr>
                                    <th class="text-center align-middle">
                                        <input type="checkbox" v-model="value.check">
                                    </th>
                                    <td class="align-middle">@{{ value.ho_va_ten}}</td>
                                    <td class="align-middle">@{{ value.so_dien_thoai}}</td>
                                    <td class="align-middle">@{{ value.email == null ? 'Chưa có' : value.email}}</td>
                                    <td class="align-middle">@{{ value.ghi_chu == null ? 'Chưa có' : value.ghi_chu}}</td>
                                    <td class="align-middle">@{{ value.ngay_sinh == null ? 'Chưa có' : value.ngay_sinh}}</td>
                                    <td class="align-middle text-center">@{{ value.ten_loai_khach}}</td>
                                    <td class="align-middle">@{{ value.ma_so_thue == null ? 'Chưa có' : value.ma_so_thue}}</td>
                                    <td class="align-middle text-center">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" v-on:click="edit_kh = Object.assign({}, value)">Cập Nhật</button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" v-on:click="delete_kh = Object.assign({}, value)">Xóa</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Họ Lót</label>
                                <input v-model="edit_kh.ho_lot" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tên Khách</label>
                                <input v-model="edit_kh.ten_khach" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số Điện Thoại</label>
                                <input v-model="edit_kh.so_dien_thoai" type="number" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input v-model="edit_kh.email" type="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ghi chú</label>
                                <input v-model="edit_kh.ghi_chu" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ngày Sinh</label>
                                <input v-model="edit_kh.ngay_sinh" type="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Loại Khách</label>
                                <select v-model="edit_kh.id_loai_khach" class="form-control">
                                    <option value="0">Mời bạn chọn</option>
                                    @foreach ($loaiKH as $key => $value )
                                        <option value="{{$value->id}}">{{$value->ten_loai_khach}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mã số thuế</label>
                                <input v-model="edit_kh.ma_so_thue" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" v-on:click="updateKhachHang()">Cập Nhật</button>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Xóa Khách Hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Bạn có chắc chắn muốn xóa khách hàng - <b class="text-danger">@{{delete_kh.ho_va_ten}}</b></h6>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" v-on:click="deleteKhachHang()">Xóa</button>
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
                add_kh : {"id_loai_khach" : 0},
                edit_kh : {"id_loai_khach" : 0},
                delete_kh : {"id_loai_khach" : 0},
                list_khach_hang : [],
                key_search : '',
            },
            created()   {
                this.loadData();
            },
            methods :   {
                Clear() {
                    axios
                        .post('/admin/khach-hang/delete-all', this.list_khach_hang)
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
                addKhachHang() {
                    $("#add").prop('disabled', true);
                    axios
                        .post('/admin/khach-hang/create', this.add_kh)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                this.add_kh = {'ho_lot' : '', 'ten_khach' : '', 'id_loai_khach' : 0, 'so_dien_thoai' : '', 'email' : '', 'ghi_chu' : '', 'ngay_sinh' : '','ma_so_thue' : ''};
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

                updateKhachHang(){
                    axios
                        .post('/admin/khach-hang/update', this.edit_kh)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                $("updateModal").modal('hide');
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

                deleteKhachHang(){
                    axios
                        .post('/admin/khach-hang/delete', this.delete_kh)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                $("deleteModal").modal('hide');
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

                loadData(){
                    axios
                        .get('/admin/khach-hang/data')
                        .then((res) => {
                            this.list_khach_hang = res.data.data;
                        });
                },

                search() {
                    var payload = {
                        'key_search'    :   this.key_search
                    }
                    axios
                        .post('/admin/khach-hang/search', payload)
                        .then((res) => {
                            this.list_khach_hang = res.data.list;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

            }
        });
    });
</script>
@endsection
