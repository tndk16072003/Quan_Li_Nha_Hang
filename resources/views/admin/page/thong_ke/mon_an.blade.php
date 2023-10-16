@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3 mt-4">
                            <h6>Thống Kê</h6>
                        </div>
                        <div class="col-3"></div>
                        @csrf
                        <div class="col">
                            <h6>Từ Ngày</h6>
                            <input v-model="thong_ke.begin" type="date" class="form-control">
                        </div>
                        <div class="col">
                            <h6>Đến Ngày</h6>
                            <input v-model="thong_ke.end" type="date" class="form-control">
                        </div>
                        <div class="col mt-4">
                            <button v-on:click="thongKeMonAn()" class="btn btn-success">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    <b>Danh Sách Món Ăn</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Món Ăn</th>
                                <th class="text-center">Số Lượng Bán</th>
                                <th class="text-center">Tổng Tiền</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in list_mon">
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="align-middle">@{{ value.ten_mon_an }}</td>
                                <td class="align-middle text-center">@{{ value.tong_so_luong_ban }}</td>
                                <td class="align-middle text-end">@{{ number_format(value.tong_tien_thanh_toan) }}</td>
                                <td class="align-middle">
                                    <button class="btn btn-primary" v-on:click="chiTietMonAn(value)">Xem Chi Tiết</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    <b>Chi Tiết Món Ăn</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Khu</th>
                                <th class="text-center">Tên Bàn</th>
                                <th class="text-center">Số Lượng</th>
                                <th class="text-center">Tổng Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in lits_ct">
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="align-middle">@{{ value.ten_khu }}</td>
                                <td class="align-middle text-center">@{{ value.ten_ban }}</td>
                                <td class="align-middle text-center">@{{ value.tong_so_luong }}</td>
                                <td class="align-middle text-end">@{{ number_format(value.tong_tien_thanh_toan) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
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
            el      :   '#app',
            data    :   {
                thong_ke  :   {},
                list_mon  :   [],
                lits_ct  :   [],
            },
            created()   {

            },
            methods :   {
                number_format(number) {
                    return new Intl.NumberFormat('vi-VI', { style: 'currency', currency: 'VND' }).format(number);
                },
                thongKeMonAn()  {
                    axios
                        .post('{{ Route("10") }}', this.thong_ke)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.list_mon = res.data.data;
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
                chiTietMonAn(value)  {
                    value.begin =  this.thong_ke.begin;
                    value.end   =  this.thong_ke.end;
                    axios
                        .post('{{ Route("11") }}', value)
                        .then((res) => {
                            this.lits_ct    = res.data.data;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
            },
        });
    });
</script>
@endsection
