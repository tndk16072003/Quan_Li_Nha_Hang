@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Thêm Mới Bàn
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Bàn</label>
                        <input v-model="add_ban.ten_ban"  v-on:keyup="createSlug()" v-on:blur="checkSlug()" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug Bàn</label>
                        <input v-model="add_ban.slug_ban" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Khu Vực</label>
                        <select v-model="add_ban.id_khu_vuc" class="form-control">
                            <option value="0">Vui lòng chọn khu vực</option>
                            @foreach ($khuVuc as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->ten_khu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá Mở Bàn</label>
                        <input v-model="add_ban.gia_mo_ban" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tiền Giờ</label>
                        <input v-model="add_ban.tien_gio" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tình Trạng</label>
                        <select v-model="add_ban.tinh_trang" class="form-control">
                            <option value="1">Hiển Thị</option>
                            <option value="0">Tạm Tắt</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button id="add" v-on:click="addBan()" class="btn btn-primary">Thêm Mới</button>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Danh Sách Bàn
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="listKhuVuc">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <button class="btn btn-danger" v-on:click="Clear()">Xóa</button>
                                </th>
                                <th class="text-center">Tên Bàn</th>
                                <th class="text-center">Slug Bàn</th>
                                <th class="text-center">ID Khu Vực</th>
                                <th class="text-center">Giá Mở Bán</th>
                                <th class="text-center">Giá Giờ</th>
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
                                    <td class="align-middle">@{{ value.ten_ban }}</td>
                                    <td class="align-middle">@{{ value.slug_ban }}</td>
                                    <td class="align-middle">@{{ value.ten_khu }}</td>
                                    <td class="align-middle text-end">@{{ number_format(value.gia_mo_ban) }}</td>
                                    <td class="align-middle text-end">@{{ number_format(value.tien_gio) }}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 1" class="btn btn-primary">Hiển Thị</button>
                                        <button v-on:click="changeStatus(value)" v-else class="btn btn-danger">Tạm Tắt</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="edit_ban = Object.assign({}, value)" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-info" >Cập Nhật</button>
                                        <button v-on:click="del_ban = value" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Bàn</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Tên Bàn</label>
                                    <input v-model="edit_ban.ten_ban"  v-on:keyup="updateSlug()" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug Bàn</label>
                                    <input v-model="edit_ban.slug_ban" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Khu Vực</label>
                                    <select v-model="edit_ban.id_khu_vuc" class="form-control">
                                        <option value="0">Vui lòng chọn khu vực</option>
                                        @foreach ($khuVuc as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->ten_khu }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giá Mở Bàn</label>
                                    <input v-model="edit_ban.gia_mo_ban" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tiền Giờ</label>
                                    <input v-model="edit_ban.tien_gio" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tình Trạng</label>
                                    <select v-model="edit_ban.tinh_trang" class="form-control">
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Bàn</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-primary" role="alert">
                                    Bạn có chắc chắn muốn xóa bàn: <b class="text-danger text-uppercase">@{{ del_ban.ten_ban }}</b> này không?
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
        el   : "#app",
        data : {
            list : [],
            add_ban  :   {'ten_ban' : '', 'slug_ban' : '', 'id_khu_vuc' : 0, 'tinh_trang' : 1},
            del_ban  :   {},
            edit_ban :   {'ten_ban' : '', 'slug_ban' : '', 'id_khu_vuc' : 0, 'tinh_trang' : 1},
        },
        created() {
            this.loadData();
        },
        methods : {
            Clear() {
                    axios
                        .post('/admin/ban/delete-all', this.list)
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
                    'slug_ban'  :   this.add_ban.slug_ban,
                };
                axios
                    .post('/admin/ban/check-slug', payload)
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
                    .post('/admin/ban/update', this.edit_ban)
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
                    .post('/admin/ban/delete', this.del_ban)
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
                var slug = this.toSlug(this.edit_ban.ten_ban);
                this.edit_ban.slug_ban = slug;
            },
            addBan() {
                $("#add").prop('disabled', true);
                axios
                    .post('/admin/ban/create', this.add_ban)
                    .then((res) => {
                        if (res.data.status == 1) {
                            toastr.success(res.data.message, "Success");
                            this.loadData();
                            this.add_ban = {'ten_khu' : '', 'slug_ban' : '', 'tinh_trang' : 1};
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
                var slug = this.toSlug(this.add_ban.ten_ban);
                this.add_ban.slug_ban = slug;
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
                    .get('/admin/ban/data')
                    .then((res) => {
                        this.list  =  res.data.data;
                    });
            },
            changeStatus(payload) {
                axios
                    .post('/admin/ban/doi-trang-thai', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message, "Success");
                            this.loadData();
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                        }
                    });
            },
            number_format(number) {
                return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
            },
        }
    });
</script>
@endsection
