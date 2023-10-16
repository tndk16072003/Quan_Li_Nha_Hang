@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Thêm Mới Khu Vực
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Khu Vực</label>
                        <input v-model="add_khu_vuc.ten_khu" v-on:keyup="createSlug()" v-on:blur="checkSlug()" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug Khu Vực</label>
                        <input v-model="add_khu_vuc.slug_khu" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tình Trạng</label>
                        <select v-model="add_khu_vuc.tinh_trang" class="form-control">
                            <option value="1">Hiển Thị</option>
                            <option value="0">Tạm Tắt</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button id="add" v-on:click="addKhuVuc()" class="btn btn-primary">Thêm Mới</button>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Danh Sách Khu Vực
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <button class="btn btn-danger" v-on:click="Clear()">Xóa</button>
                                </th>
                                <th class="text-center">Tên Khu Vực</th>
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
                                    <td class="align-middle">@{{ value.ten_khu }}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 1" class="btn btn-primary">Hiển Thị</button>
                                        <button v-on:click="changeStatus(value)" v-else class="btn btn-danger">Tạm Tắt</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="edit_khu_vuc = Object.assign({}, value)" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-info" >Cập Nhật</button>
                                        <button v-on:click="del_khu_vuc = value" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Khu Vực</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Tên Khu Vực</label>
                                    <input v-model="edit_khu_vuc.ten_khu" v-on:keyup="updateSlug()" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug Khu Vực</label>
                                    <input v-model="edit_khu_vuc.slug_khu" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tình Trạng</label>
                                    <select v-model="edit_khu_vuc.tinh_trang" class="form-control">
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Khu Vục</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-primary" role="alert">
                                    Bạn có chắc chắn muốn xóa khu vực: <b class="text-danger text-uppercase">@{{ del_khu_vuc.ten_khu }}</b> này không?
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
                list     : [],
                add_khu_vuc  :   {'ten_khu' : '', 'slug_khu' : '', 'tinh_trang' : 1},
                del_khu_vuc  :   {},
                edit_khu_vuc :   {'ten_khu' : '', 'slug_khu' : '', 'tinh_trang' : 1},
            },
            created() {
                this.loadData();
            },
            methods : {
                Clear() {
                    axios
                        .post('{{ Route("deleteAll") }}', this.list)
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
                checkSlug() {
                    var payload = {
                        'slug_khu'  :   this.add_khu_vuc.slug_khu,
                    };
                    axios
                        .post('/admin/khu-vuc/check-slug', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                $("#add").removeAttr("disabled");
                            } else if (res.data.status == 0) {
                                toastr.error(res.data.message, "Error");
                                $("#add").prop('disabled', true);
                            } else if (res.data.status == 2) {
                                toastr.warning(res.data.message, "Warning");
                            }
                        });
                },
                accpectUpdate() {
                    axios
                        .post('/admin/khu-vuc/update', this.edit_khu_vuc)
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
                        .post('/admin/khu-vuc/delete', this.del_khu_vuc)
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
                updateSlug() {
                    var slug = this.toSlug(this.edit_khu_vuc.ten_khu);
                    this.edit_khu_vuc.slug_khu = slug;
                },
                addKhuVuc() {
                    $("#add").prop('disabled', true);
                    axios
                        .post('/admin/khu-vuc/create', this.add_khu_vuc)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                this.add_khu_vuc = {'ten_khu' : '', 'slug_khu' : '', 'tinh_trang' : 1};
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
                createSlug() {
                    var slug = this.toSlug(this.add_khu_vuc.ten_khu);
                    this.add_khu_vuc.slug_khu = slug;
                },
                toSlug(str) {
                    str = str.toLowerCase();
                    str = str
                        .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
                        .replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp
                    str = str.replace(/[đĐ]/g, 'd');
                    str = str.replace(/([^0-9a-z-\s])/g, '');
                    str = str.replace(/(\s+)/g, '-');
                    str = str.replace(/-+/g, '-');
                    str = str.replace(/^-+|-+$/g, '');
                    return str;
                },
                loadData() {
                    axios
                        .get('/admin/khu-vuc/data')
                        .then((res) => {
                            this.list  =  res.data.list;
                        });
                },
                changeStatus(payload) {
                    axios
                        .post('/admin/khu-vuc/doi-trang-thai', payload)
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
