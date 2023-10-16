@extends('admin.share.master')
@section('noi_dung')
    <div class="row">
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Thêm Mới Khu Vực
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Khu Vực</label>
                        <input id="add_ten_khu" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug Khu Vực</label>
                        <input id="add_slug_khu" type="text" class="form-control">
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
                    Danh Sách Khu Vực
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="listKhuVuc">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Khu Vực</th>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận xóa dữ liệu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="edit_id">
                                    <div class="mb-3">
                                        <label class="form-label">Tên Khu Vực</label>
                                        <input type="text" class="form-control" id="edit_ten_khu">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tên Khu Vực</label>
                                        <input type="text" class="form-control" id="edit_slug_khu">
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
                var id          = $("#edit_id").val();
                var ten_khu     = $("#edit_ten_khu").val();
                var slug_khu    = $("#edit_slug_khu").val();
                var tinh_trang  = $("#edit_tinh_trang").val();
                var payload = {
                    'id'            :   id,
                    'ten_khu'       :   ten_khu,
                    'slug_khu'      :   slug_khu,
                    'tinh_trang'    :   tinh_trang,
                };

                axios
                    .post('/admin/khu-vuc/update', payload)
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

            function convert(number) {
                return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
            }

            $("#add").prop('disabled', true);

            function toSlug(str) {

                // Chuyển hết sang chữ thường
                str = str.toLowerCase();

                // xóa dấu
                str = str
                    .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
                    .replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp

                // Thay ký tự đĐ
                str = str.replace(/[đĐ]/g, 'd');

                // Xóa ký tự đặc biệt
                str = str.replace(/([^0-9a-z-\s])/g, '');

                // Xóa khoảng trắng thay bằng ký tự -
                str = str.replace(/(\s+)/g, '-');

                // Xóa ký tự - liên tiếp
                str = str.replace(/-+/g, '-');

                // xóa phần dư - ở đầu & cuối
                str = str.replace(/^-+|-+$/g, '');

                // return
                return str;
            }

            $("#add_ten_khu").blur(function() {
                var slug = toSlug($(this).val());
                var payload = {
                    'slug_khu'  :   slug
                };
                axios
                    .post('/admin/khu-vuc/check-slug', payload)
                    .then((res) => {
                        if (res.data.status == 1) {
                            toastr.success(res.data.message, "Success");
                            $("#add").removeAttr("disabled");
                        } else if (res.data.status == false) {
                            $("#add").prop('disabled', true);
                            toastr.error(res.data.message, "Error");
                            console.log(123);
                        } else if (res.data.status == 2) {
                            $("#add").prop('disabled', true);
                            toastr.warning(res.data.message, "Warning");
                        }
                    });


            })

            // Sự kiện blur (khi ra khỏi input) /key up (khi thay đổi value trong input) => nằm ở input
            $("#add_ten_khu").keyup(function() {
                var slug = toSlug($(this).val());
                $("#add_slug_khu").val(slug);
            })

            $("#edit_ten_khu").blur(function() {
                var slug = toSlug($(this).val());
                var payload = {
                    'slug_khu'      :   slug,
                    'id'            :   $("#edit_id").val(),
                };
                axios
                    .post('/admin/khu-vuc/check-slug', payload)
                    .then((res) => {
                        if (res.data.status == 1) {
                            toastr.success(res.data.message, "Success");
                            $("#accpect_update").removeAttr("disabled");
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                            $("#accpect_update").prop('disabled', true);
                        } else if (res.data.status == 2) {
                            toastr.warning(res.data.message, "Warning");
                        }
                    });
            })

            // Sự kiện blur (khi ra khỏi input) /key up (khi thay đổi value trong input) => nằm ở input
            $("#edit_ten_khu").keyup(function() {
                $("#accpect_update").prop('disabled', true);
                var slug = toSlug($(this).val());
                $("#edit_slug_khu").val(slug);
            })


            $("body").on('click', '#add', function() {
                $("#add").prop('disabled', true);
                var ten_khu     = $("#add_ten_khu").val();
                var slug_khu    = $("#add_slug_khu").val();
                var tinh_trang  = $("#add_tinh_trang").val();
                var payload = {
                    'ten_khu'       :   ten_khu,
                    'slug_khu'      :   slug_khu,
                    'tinh_trang'    :   tinh_trang,
                };

                axios
                    .post('/admin/khu-vuc/create', payload)
                    .then((res) => {
                        if (res.data.status == 1) {
                            toastr.success(res.data.message, "Success");
                            $("#add").prop('disabled', true);
                            loadData();
                            $("#add_ten_khu").val('');
                            $("#add_slug_khu").val('');
                            $("#add_tinh_trang").val(-1);
                            $("#add").removeAttr("disabled");
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                            $("#add").prop('disabled', true);
                        } else if (res.data.status == 2) {
                            toastr.warning(res.data.message, "Warning");
                            $("#add").prop('disabled', true);
                        }

                    });
            })

            // Nhiệm vụ là truy cập link => /admin/khu-vuc/data bằng method get để lấy dữ liệu
            loadData();

            function loadData() {
                axios
                    .get('/admin/khu-vuc/data')
                    .then((res) => {
                        var list = res.data.list;
                        var code = "";
                        $.each(list, function(key, value) {
                            code += '<tr>';
                            code += '<th class="text-center align-middle">' + (key + 1) + '</th>';
                            code += '<td class="align-middle">' + value.ten_khu + '</td>';
                            code += '<td class="align-middle text-center">'
                            if (value.tinh_trang) {
                                code += '<button data-idkv="' + value.id +
                                    '" class="doi-trang-thai btn btn-primary">Hiển Thị</button>';
                            } else {
                                code += '<button data-idkv="' + value.id +
                                    '" class="doi-trang-thai btn btn-warning">Tạm Tắt</button>';
                            }
                            code += '</td>';
                            code += '<td class="align-middle text-center">';
                            code += '<button data-idkv="' + value.id + '" class="edit btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#updateModal">Cập Nhật</button>';
                            code += '<button data-idkv="' + value.id + '" class="delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>';
                            code += '</td>';
                            code += '</tr>';
                        });
                        $("#listKhuVuc tbody").html(code);
                    });
            }

            $("body").on('click', '.delete', function() {
                var id = $(this).data('idkv');
                $("#id_delete").val(id);
            })

            $("body").on('click', '.edit', function() {
                var id = $(this).data('idkv');
                var payload = {
                    'id': id
                };

                axios
                    .post('/admin/khu-vuc/edit', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.warning(res.data.message, "Success");
                            $("#edit_id").val(res.data.khuVuc.id);
                            $("#edit_ten_khu").val(res.data.khuVuc.ten_khu);
                            $("#edit_slug_khu").val(res.data.khuVuc.slug_khu);
                            $("#edit_tinh_trang").val(res.data.khuVuc.tinh_trang);
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                        }
                    });
            })

            $("body").on('click', '.doi-trang-thai', function() {
                var id = $(this).data('idkv');
                var payload = {
                    'id': id
                };

                axios
                    .post('/admin/khu-vuc/doi-trang-thai', payload)
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
                    .post('/admin/khu-vuc/delete', payload)
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
