@extends('admin.share.master')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-7">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="mt-3">MENU TIẾP THỰC</h3>
                {{-- <h3 class="mt-3">MENU TIẾP THỰC</h3> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">
                                    <button class="btn btn-primary" v-on:click="Update()">Xong</button>
                                </th>
                                <th class="text-center align-middle">Tên Món Ăn</th>
                                <th class="text-center align-middle">Số Lượng</th>
                                <th class="text-center align-middle">Tên Bàn</th>
                                <th class="text-center align-middle">Ghi Chú</th>
                                <th class="text-center align-middle">Thời Gian</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class="text-center align-middle">
                                        <input type="checkbox" v-model="value.check">
                                    </th>
                                    <td class="align-middle">@{{value.ten_mon_an}}</td>
                                    <td class="text-center align-middle">@{{value.so_luong_ban}}</td>
                                    <td class="text-center align-middle">@{{value.ten_ban}}</td>
                                    <td class="align-middle">@{{value.ghi_chu}}</td>
                                    <td class="text-center align-middle">@{{date_format(value.updated_at)}}</td>
                                    <td class="text-center align-middle">
                                        <button v-on:click="Done(value)" class="btn btn-primary">Xong</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
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
                list   :   [],
            },
            created()   {
                this.loadData();
            },
            methods :   {
                Update() {
                    axios
                        .post('/admin/tiep-thuc/update-all', this.list)
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

                loadData() {
                    axios
                        .get('/admin/tiep-thuc/data-tiep-thuc')
                        .then((res) => {
                            this.list  =  res.data.data;
                        });
                },
                date_format(now) {
                    return moment(now).format('HH:mm:ss');
                },
            },
        });
    });
</script>
@endsection
