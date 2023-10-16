@extends('admin.share.master')
@section('noi_dung')
    <div class="row">
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Thêm Mới Danh Mục
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Danh Mục</label>
                        <input id="add_ten_danh_muc" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tình Trạng</label>
                        <select id="add_tinh_trang" class="form-control">
                            <option value="-1">Vui lòng chọn tình trạng</option>
                            <option value="1">Hiển Thị</option>
                            <option value="0">Tạm Tắt</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button id="add" class="btn btn-primary">Thêm Mới</button>
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
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Danh Mục</th>
                                <th class="text-center">Tình Trạng</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center align-middle">1</th>
                                <td class="align-middle">AAA</td>
                                <td class="align-middle">
                                    <button class="btn btn-primary">Hiển Thị</button>
                                </td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-info">Cập Nhật</button>
                                    <button class="btn btn-danger ml-1">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận xóa dữ liệu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" id="id_delete">
                                    <div class="alert alert-primary" role="alert">
                                        Bạn chắc chắn sẽ xóa dữ liệu khu vực này!. Việc này không thể thay đổi, hãy cẩn thận.
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button id="accpect_delete" type="button" class="btn btn-danger" data-bs-dismiss="modal">Xác Nhận Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="edit_id">
                                    <div class="mb-3">
                                        <label class="form-label">Tên Danh Mục</label>
                                        <input type="text" class="form-control" id="edit_ten_danh_muc">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tình Trạng</label>
                                        <select class="form-control" id="edit_tinh_trang">
                                            <option value="1">Hiển Thị</option>
                                            <option value="0">Tạm Tắt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button id="accpect_update" type="button" class="btn btn-success">Cập Nhật</button>
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

            $("#accpect_update").click(function() {
                var id              = $("#edit_id").val();
                var ten_danh_muc    = $("#edit_ten_danh_muc").val();
                var tinh_trang      = $("#edit_tinh_trang").val();
                var payload = {
                    'id'            :   id,
                    'ten_danh_muc'  :   ten_danh_muc,
                    'tinh_trang'    :   tinh_trang,
                };

                axios
                    .post('/admin/danh-muc/update', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message, "Success");
                            loadData();
                            $('#updateModal').modal('hide');
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                        }
                    });
            });


            $("body").on('click', '#add', function() {
                var ten_danh_muc    = $("#add_ten_danh_muc").val();
                var tinh_trang      = $("#add_tinh_trang").val();
                var payload = {
                    'ten_danh_muc'  :   ten_danh_muc,
                    'tinh_trang'    :   tinh_trang,
                };

                axios
                    .post('/admin/danh-muc/create', payload)
                    .then((res) => {
                        if (res.data.status == 1) {
                            toastr.success(res.data.message, "Success");
                            loadData();
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                        } else if (res.data.status == 2) {
                            toastr.warning(res.data.message, "Warning");
                        }
                        $("#add_ten_danh_muc").val('');
                        $("#add_tinh_trang").val(-1);
                    });
            })

            // Nhiệm vụ là truy cập link => /admin/danh-muc/data bằng method get để lấy dữ liệu
            loadData();

            function loadData() {
                axios
                    .get('/admin/danh-muc/data')
                    .then((res) => {
                        var list = res.data.list;
                        var code = "";
                        $.each(list, function(key, value) {
                            code += '<tr>';
                            code += '<th class="text-center align-middle">' + (key + 1) + '</th>';
                            code += '<td class="align-middle">' + value.ten_danh_muc + '</td>';
                            code += '<td class="align-middle text-center">'
                            if (value.tinh_trang) {
                                code += '<button data-idma="' + value.id +
                                    '" class="doi-trang-thai btn btn-primary">Hiển Thị</button>';
                            } else {
                                code += '<button data-idma="' + value.id +
                                    '" class="doi-trang-thai btn btn-warning">Tạm Tắt</button>';
                            }
                            code += '</td>';
                            code += '<td class="align-middle text-center">';
                            code += '<button data-idma="' + value.id + '" class="edit btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#updateModal">Cập Nhật</button>';
                            code += '<button data-idma="' + value.id + '" class="delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>';
                            code += '</td>';
                            code += '</tr>';
                        });
                        $("#listMonAn tbody").html(code);
                    });
            }

            $("body").on('click', '.delete', function() {
                var id = $(this).data('idma');
                $("#id_delete").val(id);
            })

            $("body").on('click', '.edit', function() {
                var id = $(this).data('idma');
                var payload = {
                    'id': id
                };

                axios
                    .post('/admin/danh-muc/edit', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.warning(res.data.message, "Success");
                            $("#edit_id").val(res.data.danhMuc.id);
                            $("#edit_ten_danh_muc").val(res.data.danhMuc.ten_danh_muc);
                            $("#edit_tinh_trang").val(res.data.danhMuc.tinh_trang);
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                        }
                    });
            })

            $("body").on('click', '.doi-trang-thai', function() {
                var id = $(this).data('idma');
                var payload = {
                    'id': id
                };

                axios
                    .post('/admin/danh-muc/doi-trang-thai', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message, "Success");
                            loadData();
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                        }
                    });
            })

            $("body").on('click', '#accpect_delete', function() {
                var id = $("#id_delete").val();
                var payload = {
                    'id': id
                };

                axios
                    .post('/admin/danh-muc/delete', payload)
                    .then((res) => {
                        if (res.data.status == 1) {
                            toastr.success(res.data.message, "Success");
                            loadData();
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                        } else if (res.data.status == 2) {
                            toastr.warning(res.data.message, "Warning");
                        }
                    });
            });
        });
    </script>
@endsection
