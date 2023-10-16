@extends('admin.share.master')
@section('noi_dung')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 mt-4">
                        </div>
                        <div class="col-3"></div>
                        <div class="col">
                            <h6>Từ Ngày</h6>
                            <input id="begin" type="date" class="form-control">
                        </div>
                        <div class="col">
                            <h6>Đến Ngày</h6>
                            <input id="end" type="date" class="form-control">
                        </div>
                        <div class="col mt-4">
                            <button class="btn btn-success" id="thongKe" type="button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var list_ten = [];
        var list_tien = [];
        var char = document.getElementById('myChart');
        var  myChar = new Chart(char, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: '# of Votes',
                        data: [],
                        borderWidth: 1,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(217, 136, 128)',
                            'rgb(192, 57, 43)',
                            'rgb(195, 155, 211 )',
                            'rgb(136, 78, 160)',
                            'rgb(84, 153, 199)',
                            'rgb(21, 67, 96)',
                            'rgb(46, 204, 113)',
                            'rgb(241, 196, 15)',
                            'rgb(160, 64, 0)',
                        ],
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

        $("#thongKe").click(function() {
            var payload = {
                "begin": $("#begin").val(),
                "end": $("#end").val(),
            };
            axios
                .post('{{ Route('thongKe') }}', payload)
                .then((res) => {
                    list_ten = res.data.list_ten;
                    list_tien = res.data.list_tien;
                })
                .finally(function () {
                    myChar.data.labels = list_ten;
                    myChar.data.datasets[0].data  = list_tien;
                    myChar.update();
                });
        });

        function showChart(list_ten, list_tien) {

        };
    </script>
@endsection
