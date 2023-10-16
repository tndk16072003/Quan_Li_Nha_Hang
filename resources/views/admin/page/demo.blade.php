@extends('admin.share.master')
@section('noi_dung')
<div class="row">
    <div class="col-4"></div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                Danh Sách Nhà Cung Cấp
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Thông Tin Công Ty</th>
                            <th class="text-center">Thông Tin Liên Hệ</th>
                            <th class="text-center">Tình Trạng</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i < 6; $i++)
                        <tr>
                            <th class="text-center align-middle">{{ $i }}</th>
                            <td class="align-middle">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Mã số thuế</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Tên công ty</th>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                            <td class="align-middle">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Tên liên hệ</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Tên gợi nhớ</th>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                            <td class="text-center align-middle">
                                <button class="btn btn-warning">Tạm Dừng</button>
                            </td>
                            <td class="text-center align-middle">
                                <button class="btn btn-info">Cập Nhật</button>
                                <button class="btn btn-danger">Xóa Bỏ</button>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
