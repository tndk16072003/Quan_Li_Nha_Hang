@extends('admin.share.master')
@section('noi_dung')
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
                            <input id="begin" type="date" class="form-control">
                        </div>
                        <div class="col">
                            <h6>Đến Ngày</h6>
                            <input id="end" type="date" class="form-control">
                        </div>
                        <div class="col mt-4">
                            <button id="thongKe" class="btn btn-success">
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
        <div class="card">
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    var lables = [];
    var datas  = [];
    $("#thongKe").click(function () {
        const payload = {
            'begin' : $("#begin").val(),
            'end'   : $("#end").val(),
        };
        axios
            .post('{{ Route("12") }}', payload)
            .then((res) => {
                lables = res.data.lables;
                datas = res.data.datas;
                actionShowChart(lables, datas);
            })
    })
    function actionShowChart(lables, datas) {
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'polarArea',
            data: {
            labels: lables,
            datasets: [{
                label: '# Top 7 Món Ăn Yêu Thích',
                data: datas,
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
    }


</script>
@endsection
