@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
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
                            <button v-on:click="thongKeBanHang()" class="btn btn-success">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header">
                    <b>Chi Tiết Bán Hàng</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Ngày Hóa Đơn</th>
                                <th class="text-center">Giảm Giá</th>
                                <th class="text-center">Tổng Tiền</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in list_hd">
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="align-middle">@{{ value.ngay_thanh_toan }}</td>
                                <td class="align-middle">@{{ value.giam_gia }}</td>
                                <td class="align-middle">@{{ value.tong_tien }}</td>
                                <td class="align-middle">
                                    <button class="btn btn-primary" v-on:click="chiTietBanHang(value)">Xem Chi Tiết</button>
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
                    <b>Chi Tiết Hóa Đơn -  </b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Món</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in lits_ct">
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="align-middle">@{{ value.ten_mon_an }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">

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
                thong_ke :   {},
                list_hd  :   [],
                lits_ct  :   [],
            },
            created()   {

            },
            methods :   {
                thongKeBanHang()  {
                    axios
                        .post('{{ Route("8") }}', this.thong_ke)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.list_hd = res.data.data;
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
                chiTietBanHang(value)  {
                    axios
                        .post('{{ Route("9") }}', value)
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
