@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-3">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header text-center bg-gradient-bloody text-white">
                <i><b>TẠO QUYỀN</b></i>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Tên Quyền</label>
                    <input v-model='add_quyen.ten_quyen' type="text" class="form-control">
                </div>
            </div>
            <div class="card-footer text-end">
                <button id="add" v-on:click="addQuyen()" class="btn btn-inverse-primary">Tạo Mới</button>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header text-center bg-gradient-bloody text-white">
                <b>DANH SÁCH QUYỀN</b>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        {{-- <tr>
                            <th class="align-middle text-center">Tìm kiếm</th>
                            <th colspan="2">
                                <input v-model="key_search" v-on:keyup.enter="search()" type="text" class="form-control">
                            </th>
                            <th class="text-center text-white">
                                <button class="btn btn-inverse-info" v-on:click="search()">Tìm Kiếm</button>
                            </th> --}}
                        </tr>
                        <tr>
                            <th class="text-center">
                                <button class="btn btn-inverse-danger" v-on:click="Clear()">Xóa</button>
                            </th>
                            <th class="text-center">Tên Quyền</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(value, key) in list">
                            <tr>
                                <th class="text-center align-middle">
                                    <input type="checkbox" v-model="value.check">
                                </th>
                                <td class="align-middle text-nowrap">@{{ value.ten_quyen }}</td>
                                <td class="align-middle text-center text-nowrap">
                                    <button v-on:click="edit_quyen = Object.assign({}, value), getPhanQuyenDetail(value.list_id_quyen)" class="btn btn-inverse-success">Cấp Quyền</button>
                                    <button v-on:click="edit_quyen = Object.assign({}, value)" class="btn btn-inverse-info" data-bs-toggle="modal" data-bs-target="#updateModal">Cập Nhật</button>
                                    <button v-on:click="del_quyen = value" class="btn btn-inverse-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Quyền</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Tên Quyền</label>
                                <input v-model="edit_quyen.ten_quyen" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-inverse-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="accpectUpdate()" type="button" class="btn btn-inverse-warning">Xác Nhận</button>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Quyền</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-primary" role="alert">
                                Bạn có chắc chắn muốn xóa quyền: <b class="text-danger text-uppercase">@{{ del_quyen.ten_quyen }}</b> này không?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-inverse-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-inverse-danger" v-on:click="accpectDel()" data-bs-dismiss="modal">Xác Nhận</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header text-center bg-gradient-bloody text-white">
                <b>PHÂN QUYỀN @{{ edit_quyen.ten_quyen }}</b>
            </div>
            <div class="card-body">
                <div class="row">
                    <template v-for="(value, key) in list_phan_quyen">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" v-model="array_quyen" type="checkbox" v-bind:value="value.id" v-bind:id="'quyen_' + value.id">
                                <label class="form-check-label" v-bind:for="'quyen_' +  value.id">@{{ value.ten_chuc_nang }}</label>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <button class="btn btn-inverse-primary" v-on:click="phanQuyen()" style="width: 95%">Cập Nhập Phân Quyền</button>
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
                list                :   [],
                list_phan_quyen     :   [],
                add_quyen           :   {},
                del_quyen           :   {},
                edit_quyen          :   {},
                key_search          :   '',
                search_quyen        :   '',
                array_quyen         :   [],

            },
            created()   {
                this.loadData();
                this.loadDataQuyen();
                this.loadDanhSachMon();
            },
            methods :   {
                Clear() {
                    axios
                        .post('/admin/quyen/delete-all', this.list)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                            } else {
                                toastr.error(res.data.message);
                                this.loadData();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                phanQuyen() {
                    var payload = {
                        'id_quyen'          : this.edit_quyen.id,
                        'list_phan_quyen'   : this.array_quyen,
                    };
                    axios
                        .post('/admin/quyen/phan-quyen', payload)
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

                getPhanQuyenDetail(list_rule) {
                    if (list_rule) {
                        if ( list_rule.indexOf(","))
                            this.array_quyen = list_rule.split(",");
                        else {
                            this.array_quyen.push(list_rule);
                        }
                    } else {
                        this.array_quyen = [];
                    }
                },

                addQuyen() {
                    $("#add").prop('disabled', true);
                    var payload = {
                        'ten_quyen'    :   this.add_quyen.ten_quyen,
                        'list_id_quyen'    :   this.add_quyen.list_id_quyen,
                    };
                    axios
                        .post('/admin/quyen/create', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, "Success");
                                this.loadData();
                                this.add_quyen = {'ten_quyen' : '',  'list_id_quyen' : ''};
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

                accpectUpdate() {
                    axios
                        .post('/admin/quyen/update', this.edit_quyen)
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
                        .post('/admin/quyen/delete', this.del_quyen)
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
                        .get('/admin/quyen/data')
                        .then((res) => {
                            this.list  =  res.data.list;
                        });
                },

                loadDataQuyen() {
                    axios
                        .get('/admin/quyen/data-quyen')
                        .then((res) => {
                            this.list_phan_quyen  =  res.data.data;
                        });
                },

                search() {
                    var payload = {
                        'key_search'    :   this.key_search
                    }
                    axios
                        .post('/admin/quyen/search', payload)
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
