@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="baocon">
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Thêm Mới Món Ăn
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Món Ăn</label>
                        <input v-model="add_mon_an.ten_mon" v-on:blur="checkSlug()" v-on:keyup="createSlug()" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug Món Ăn</label>
                        <input v-model="add_mon_an.slug_mon" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá Bán</label>
                        <input v-model="add_mon_an.gia_ban" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Danh Mục</label>
                        <select v-model="add_mon_an.id_danh_muc" class="form-control">
                            <option value="0">Vui lòng chọn danh mục</option>
                            @foreach ($danhMuc as $key => $value)
                                <option value="{{$value->id}}">{{$value->ten_danh_muc}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tình Trạng</label>
                        <select v-model="add_mon_an.tinh_trang" class="form-control">
                            <option value="1">Hiển Thị</option>
                            <option value="0">Tạm Tắt</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button id="add" v-on:click="addMonAn()" class="btn btn-primary">Thêm Mới</button>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Danh Sách Món Ăn
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <button class="btn btn-danger" v-on:click="Clear()">Xóa</button>
                                </th>
                                <th class="text-center">Tên Món Ăn</th>
                                <th class="text-center">Giá bán</th>
                                <th class="text-center">Id danh mục</th>
                                <th class="text-center">Tình Trạng</th>
                                <th class="text-center">Ngày Cập Nhật</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class="text-center align-middle">
                                        <input type="checkbox" v-model="value.check">
                                    </th>
                                    <td class="align-middle">@{{ value.ten_mon }}</td>
                                    <td class="align-middle">@{{ number_format(value.gia_ban) }}</td>
                                    <td class="align-middle">@{{ value.ten_danh_muc }}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="changeStatus(value)" v-if="value.tinh_trang == 0" class="btn btn-warning">Dừng Bán</button>
                                        <button v-on:click="changeStatus(value)" v-else class="btn btn-primary">Đang Bán</button>
                                    </td>
                                    <td class="align-middle text-center">@{{ date_format(value.updated_at) }}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="edit_mon_an = Object.assign({}, value)" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateModal">Cập Nhật</button>
                                        <button v-on:click="del_mon_an = value" class="btn btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
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
                                    <label class="form-label">Tên Món Ăn</label>
                                    <input v-model="edit_mon_an.ten_mon" v-on:keyup="updateSlug()" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug Món Ăn</label>
                                    <input v-model="edit_mon_an.slug_mon" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giá Bán</label>
                                    <input v-model="edit_mon_an.gia_ban" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Danh Mục</label>
                                    <select v-model="edit_mon_an.id_danh_muc" class="form-control">
                                        <option value="0">Vui lòng chọn danh mục</option>
                                        @foreach ($danhMuc as $key => $value)
                                            <option value="{{$value->id}}">{{$value->ten_danh_muc}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tình Trạng</label>
                                    <select v-model="edit_mon_an.tinh_trang" class="form-control">
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Món Ăn</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-primary" role="alert">
                                    Bạn có chắc chắn muốn xóa món: <b class="text-danger text-uppercase">@{{ del_mon_an.ten_mon }}</b> này không?
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
    $(document).ready(function() {
        new Vue({
            el      :       '#baocon',
            data    :       {
                list        :   [],
                add_mon_an  :   {'ten_mon' : '', 'slug_mon' : '', 'id_danh_muc' : 0},
                del_mon_an  :   {},
                edit_mon_an :   {'ten_mon' : '', 'slug_mon' : '', 'id_danh_muc' : 0},
            },
            created()   {
                this.loadData();
            },
            methods :   {
                Clear() {
                    axios
                        .post('/admin/mon-an/delete-all', this.list)
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
                        'slug_mon'  :   this.add_mon_an.slug_mon,
                    };
                    axios
                        .post('/admin/mon-an/check-slug', payload)
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
                        .post('/admin/mon-an/update', this.edit_mon_an)
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
                        .post('/admin/mon-an/delete', this.del_mon_an)
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
                addMonAn() {
                    $("#add").prop('disabled', true);
                    axios
                        .post('/admin/mon-an/create', this.add_mon_an)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                this.add_mon_an = {'ten_mon' : '', 'slug_mon' : '', 'id_danh_muc' : 0, 'gia_ban' : '', 'tinh_trang' : 1};
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
                updateSlug() {
                    var slug = this.toSlug(this.edit_mon_an.ten_mon);
                    this.edit_mon_an.slug_mon = slug;
                },
                createSlug() {
                    var slug = this.toSlug(this.add_mon_an.ten_mon);
                    this.add_mon_an.slug_mon = slug;
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
                        .get('/admin/mon-an/data')
                        .then((res) => {
                            this.list  =  res.data.list;
                        });
                },
                changeStatus(abcxyz) {
                    axios
                        .post('/admin/mon-an/doi-trang-thai', abcxyz)
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
                date_format(now) {
                    return moment(now).format('HH:mm:ss DD/MM/yyyy');
                },

            },
        });
    });
</script>
@endsection
