@extends('admin.share.master')
@section('noi_dung')
    <div class="row">
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    Thêm Mới Bàn
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên Bàn</label>
                        <input id="add_ten_ban" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug Bàn</label>
                        <input id="add_slug_ban" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Khu Vực</label>
                        <select id="add_id_khu_vuc" class="form-control">
                            <option value="0">Vui lòng chọn khu vực</option>
                            @foreach ($khuVuc as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->ten_khu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá Mở Bàn</label>
                        <input id="add_gia_mo_ban" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tiền Giờ</label>
                        <input id="add_tien_gio" type="text" class="form-control">
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
                    Danh Sách Bàn
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="listKhuVuc">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
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
                                        <label class="form-label">Tên Bàn</label>
                                        <input type="text" id="edit_ten_ban" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Slug Bàn</label>
                                        <input type="text" id="edit_slug_ban" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Khu Vực</label>
                                        <select id="edit_id_khu_vuc" class="form-control">
                                            <option value="0">Vui lòng chọn khu vực</option>
                                            @foreach ($khuVuc as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->ten_khu }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Giá Mở Bàn</label>
                                        <input type="text" id="edit_gia_mo_ban" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Giá Giờ</label>
                                        <input type="text" id="edit_tien_gio" class="form-control">
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
            var ten_ban     = $("#edit_ten_ban").val();
            var slug_ban    = $("#edit_slug_ban").val();
            var id_khu_vuc  = $("#edit_id_khu_vuc").val();
            var gia_mo_ban  = $("#edit_gia_mo_ban").val();
            var tien_gio    = $("#edit_tien_gio").val();
            var tinh_trang  = $("#edit_tinh_trang").val();
            var payload = {
                'id'            :   id,
                'ten_ban'       :   ten_ban,
                'slug_ban'      :   slug_ban,
                'id_khu_vuc'    :   id_khu_vuc,
                'gia_mo_ban'    :   gia_mo_ban,
                'tien_gio'      :   tien_gio,
                'tinh_trang'    :   tinh_trang,
            };

            axios
                .post('/admin/ban/update', payload)
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

        $("#add_ten_ban").blur(function() {
            var slug = toSlug($(this).val());
            var payload = {
                'slug_ban'  :   slug
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


        })

        // Sự kiện blur (khi ra khỏi input) /key up (khi thay đổi value trong input) => nằm ở input
        $("#add_ten_ban").keyup(function() {
            var slug = toSlug($(this).val());
            $("#add_slug_ban").val(slug);
        })

        $("#edit_ten_ban").blur(function() {
            var slug = toSlug($(this).val());
            var payload = {
                'slug_ban'  :   slug,
                'id'        :   $("#edit_id").val(),
            };
            axios
                .post('/admin/ban/check-slug', payload)
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
        $("#edit_ten_ban").keyup(function() {
            $("#accpect_update").prop('disabled', true);
            var slug = toSlug($(this).val());
            $("#edit_slug_ban").val(slug);
        })


        $("body").on('click', '#add', function() {
            $("#add").prop('disabled', true);
            var ten_ban     = $("#add_ten_ban").val();
            var slug_ban    = $("#add_slug_ban").val();
            var id_khu_vuc  = $("#add_id_khu_vuc").val();
            var gia_mo_ban  = $("#add_gia_mo_ban").val();
            var tien_gio    = $("#add_tien_gio").val();
            var tinh_trang  = $("#add_tinh_trang").val();
            var payload = {
                'ten_ban'       :   ten_ban,
                'slug_ban'      :   slug_ban,
                'id_khu_vuc'    :   id_khu_vuc,
                'gia_mo_ban'    :   gia_mo_ban,
                'tien_gio'      :   tien_gio,
                'tinh_trang'    :   tinh_trang,
            };

            axios
                .post('/admin/ban/create', payload)
                .then((res) => {
                    if (res.data.status == 1) {
                        toastr.success(res.data.message, "Success");
                        loadData();
                    } else if (res.data.status == 0) {
                        toastr.error(res.data.message, "Error");
                    } else if (res.data.status == 2) {
                        toastr.warning(res.data.message, "Warning");
                    }
                    $("#add_ten_ban").val('');
                    $("#add_slug_ban").val('');
                    $("#add_gia_mo_ban").val('');
                    $("#add_tien_gio").val('');
                    $("#add_id_khu_vuc").val(0);
                    $("#add_tinh_trang").val(-1);
                    $("#add").removeAttr("disabled");
                });
        })

        // Nhiệm vụ là truy cập link => /admin/ban/data bằng method get để lấy dữ liệu
        loadData();

        function loadData() {
            axios
                .get('/admin/ban/data')
                .then((res) => {
                    var list = res.data.list;
                    var code = "";
                    $.each(list, function(key, value) {
                        code += '<tr>';
                        code += '<th class="text-center align-middle">' + (key + 1) + '</th>';
                        code += '<td class="align-middle">' + value.ten_ban + '</td>';
                        code += '<td class="align-middle">' + value.slug_ban + '</td>';
                        code += '<td class="align-middle">' + value.ten_khu + '</td>';
                        code += '<td class="align-middle text-end">' + convert(value.gia_mo_ban) + '</td>';
                        code += '<td class="align-middle text-end">' + convert(value.tien_gio) + '</td>';
                        code += '<td class="align-middle text-center">'
                        if (value.tinh_trang) {
                            code += '<button data-idban="' + value.id +
                                '" class="doi-trang-thai btn btn-primary">Hiển Thị</button>';
                        } else {
                            code += '<button data-idban="' + value.id +
                                '" class="doi-trang-thai btn btn-warning">Tạm Tắt</button>';
                        }
                        code += '</td>';
                        code += '<td class="align-middle text-center">';
                        code += '<button data-idban="' + value.id + '" class="edit btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#updateModal">Cập Nhật</button>';
                        code += '<button data-idban="' + value.id + '" class="delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa Bỏ</button>';
                        code += '</td>';
                        code += '</tr>';
                    });
                    $("#listKhuVuc tbody").html(code);
                });
        }

        $("body").on('click', '.delete', function() {
            var id = $(this).data('idban');
            $("#id_delete").val(id);
        })

        $("body").on('click', '.edit', function() {
            var id = $(this).data('idban');
            var payload = {
                'id': id
            };

            axios
                .post('/admin/ban/edit', payload)
                .then((res) => {
                    if (res.data.status) {
                        // toastr.warning(res.data.message, "Success");
                        $("#edit_id").val(res.data.ban.id);
                        $("#edit_ten_ban").val(res.data.ban.ten_ban);
                        $("#edit_slug_ban").val(res.data.ban.slug_ban);
                        $("#edit_id_khu_vuc").val(res.data.ban.id_khu_vuc);
                        $("#edit_gia_mo_ban").val(res.data.ban.gia_mo_ban);
                        $("#edit_tien_gio").val(res.data.ban.tien_gio);
                        $("#edit_tinh_trang").val(res.data.ban.tinh_trang);
                    } else if (res.data.status == 0) {
                        toastr.error(res.data.message, "Error");
                    }
                });
        })

        $("body").on('click', '.doi-trang-thai', function() {
            var id = $(this).data('idban');
            var payload = {
                'id': id
            };

            axios
                .post('/admin/ban/doi-trang-thai', payload)
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
                .post('/admin/ban/delete', payload)
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
