@extends('admin.share.master')
@section('noi_dung')
    <div class="row">
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Thêm Mới Món Ăn
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Món Ăn</label>
                        <input id="add_ten_mon" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug Món Ăn</label>
                        <input id="add_slug_mon" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá Bán</label>
                        <input id="add_gia_ban" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Id danh mục</label>
                        <select id="add_id_danh_muc" class="form-control">
                            <option value="0">Vui lòng chọn danh mục</option>
                            @foreach ($danhMuc as $key => $value)
                                <option value="{{$value->id}}">{{$value->ten_danh_muc}}</option>
                            @endforeach
                        </select>
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
                    Danh Sách Món Ăn
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="listMonAn">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Món Ăn</th>
                                <th class="text-center">Giá bán</th>
                                <th class="text-center">Danh mục</th>
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
                                        <label class="form-label">Tên Món Ăn</label>
                                        <input type="text" class="form-control" id="edit_ten_mon">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Slug Món Ăn</label>
                                        <input type="text" class="form-control" id="edit_slug_mon">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Giá bán</label>
                                        <input type="text" class="form-control" id="edit_gia_ban">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Danh mục</label>
                                        <select class="form-control" id="edit_id_danh_muc">
                                            @foreach ($danhMuc as $key => $value)
                                                <option value="{{$value->id}}">{{$value->ten_danh_muc}}</option>
                                            @endforeach
                                        </select>
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
                var ten_mon     = $("#edit_ten_mon").val();
                var slug_mon    = $("#edit_slug_mon").val();
                var gia_ban     = $("#edit_gia_ban").val();
                var id_danh_muc = $("#edit_id_danh_muc").val();
                var tinh_trang  = $("#edit_tinh_trang").val();
                var payload = {
                    'id'            :   id,
                    'ten_mon'       :   ten_mon,
                    'slug_mon'      :   slug_mon,
                    'gia_ban'       :   gia_ban,
                    'id_danh_muc'   :   id_danh_muc,
                    'tinh_trang'    :   tinh_trang,
                };

                axios
                    .post('/admin/mon-an/update', payload)
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

            $("#add_ten_mon").blur(function() {
                var slug = toSlug($(this).val());
                var payload = {
                    'slug_mon'  :   slug
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


            })

            // Sự kiện blur (khi ra khỏi input) /key up (khi thay đổi value trong input) => nằm ở input
            $("#add_ten_mon").keyup(function() {
                var slug = toSlug($(this).val());
                $("#add_slug_mon").val(slug);
            })

            $("#edit_ten_mon").blur(function() {
                var slug = toSlug($(this).val());
                var payload = {
                    'slug_mon'  :   slug,
                    'id'        :   $("#edit_id").val(),
                };
                axios
                    .post('/admin/mon-an/check-slug', payload)
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
            $("#edit_ten_mon").keyup(function() {
                $("#accpect_update").prop('disabled', true);
                var slug = toSlug($(this).val());
                $("#edit_slug_mon").val(slug);
            })


            $("body").on('click', '#add', function() {
                $("#add").prop('disabled', true);
                var ten_mon     = $("#add_ten_mon").val();
                var slug_mon    = $("#add_slug_mon").val();
                var gia_ban     = $("#add_gia_ban").val();
                var id_danh_muc = $("#add_id_danh_muc").val();
                var tinh_trang  = $("#add_tinh_trang").val();
                var payload = {
                    'ten_mon'       :   ten_mon,
                    'slug_mon'      :   slug_mon,
                    'gia_ban'       :   gia_ban,
                    'id_danh_muc'   :   id_danh_muc,
                    'tinh_trang'    :   tinh_trang,
                };

                axios
                    .post('/admin/mon-an/create', payload)
                    .then((res) => {
                        if (res.data.status == 1) {
                            toastr.success(res.data.message, "Success");
                            loadData();
                            $("#add_ten_mon").val('');
                            $("#add_slug_mon").val('');
                            $("#add_gia_ban").val('');
                            $("#add_id_danh_muc").val(0);
                            $("#add_tinh_trang").val(-1);
                            $("#add").removeAttr("disabled");
                        } else if (res.data.status == 0) {
                            toastr.error(res.data.message, "Error");
                        } else if (res.data.status == 2) {
                            toastr.warning(res.data.message, "Warning");
                        }
                    });
            })

            // Nhiệm vụ là truy cập link => /admin/mon-an/data bằng method get để lấy dữ liệu
            loadData();

            function loadData() {
                axios
                    .get('/admin/mon-an/data')
                    .then((res) => {
                        var list = res.data.list;
                        var code = "";
                        $.each(list, function(key, value) {
                            code += '<tr>';
                            code += '<th class="text-center align-middle">' + (key + 1) + '</th>';
                            code += '<td class="align-middle">' + value.ten_mon + '</td>';
                            code += '<td class="align-middle text-end">' + convert(value.gia_ban) + '</td>';
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
                    .post('/admin/mon-an/edit', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.warning(res.data.message, "Success");
                            $("#edit_id").val(res.data.monAn.id);
                            $("#edit_ten_mon").val(res.data.monAn.ten_mon);
                            $("#edit_slug_mon").val(res.data.monAn.slug_mon);
                            $("#edit_gia_ban").val(res.data.monAn.gia_ban);
                            $("#edit_id_danh_muc").val(res.data.monAn.id_danh_muc);
                            $("#edit_tinh_trang").val(res.data.monAn.tinh_trang);
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
                console.log(payload);
                axios
                    .post('/admin/mon-an/doi-trang-thai', payload)
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
                    .post('/admin/mon-an/delete', payload)
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
