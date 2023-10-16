@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Thêm Mới Danh Mục
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Danh Mục</label>
                        <input v-model="add_danh_muc.ten_danh_muc" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tình Trạng</label>
                        <select v-model="add_danh_muc.tinh_trang" class="form-control">
                            <option value="1">Hiển Thị</option>
                            <option value="0">Tạm Tắt</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button id="add" v-on:click="addDanhMuc()" class="btn btn-primary">Thêm Mới</button>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Danh Sách Danh Mục
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="listMonAn">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <button class="btn btn-danger" v-on:click="Clear()">Xóa</button>
                                </th>
                                <th class="text-center">Tên Danh Mục</th>
                                <th class="text-center">Tình Trạng</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class="text-center align-middle">
                                        <input type="checkbox" v-model="value.check">
                                    </th>
                                    <td class="align-middle">@{{value.ten_danh_muc}}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 1" class="btn btn-primary">Hiển Thị</button>
                                        <button v-on:click="changeStatus(value)" v-else class="btn btn-danger">Tạm Tắt</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="edit_danh_muc = Object.assign({}, value)" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-info" >Cập Nhật</button>
                                        <button v-on:click="del_danh_muc = value" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Danh Mục</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Tên Danh Mục</label>
                                    <input v-model="edit_danh_muc.ten_danh_muc" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tình Trạng</label>
                                    <select v-model="edit_danh_muc.tinh_trang" class="form-control">
                                        <option value="">Vui lòng chọn tình trạng</option>
                                        <option value="1">Hiển Thị</option>
                                        <option value="0">Tạm Tắt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button v-on:click="accpectUpdate()" type="button" class="btn btn-warning">Xác Nhận</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Danh Mục</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-primary" role="alert">
                                    Bạn có chắc chắn muốn xóa danh mục: <b class="text-danger text-uppercase">@{{ del_danh_muc.ten_danh_muc }}</b> này không?
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        new Vue({
            el : "#app",
            data : {
                list          : [],
                add_danh_muc  : {'ten_danh_muc' : '', 'tinh_trang' : 1},
                del_danh_muc  : {},
                edit_danh_muc : {'ten_danh_muc' : '', 'tinh_trang' : 1},
            },
            created() {
                this.loadData();
            },
            methods : {
                Clear() {
                    axios
                        .post('/admin/danh-muc/delete-all', this.list)
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
                accpectUpdate() {
                    axios
                        .post('/admin/danh-muc/update', this.edit_danh_muc)
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
                        .post('/admin/danh-muc/delete', this.del_danh_muc)
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
                addDanhMuc() {
                    $("#add").prop('disabled', true);
                    axios
                        .post('/admin/danh-muc/create', this.add_danh_muc)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                this.add_danh_muc = {'ten_danh_muc' : '', 'tinh_trang' : 1};
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
                loadData() {
                    axios
                        .get('/admin/danh-muc/data')
                        .then((res) => {
                            this.list  =  res.data.list;
                        });
                },
                changeStatus(payload) {
                    axios
                        .post('/admin/danh-muc/doi-trang-thai', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                            }
                        });
                },
            }
        });
    </script>
@endsection
