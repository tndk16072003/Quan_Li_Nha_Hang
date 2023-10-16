@extends('admin.share.master')
@section('noi_dung')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="/admin/thong-ke/chart" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-3 mt-4">
                            {{-- <h6>Thống Kê</h6> --}}
                        </div>
                        <div class="col-3"></div>
                        <div class="col">
                            <h6>Từ Ngày</h6>
                            <input name="begin" type="date" class="form-control">
                        </div>
                        <div class="col">
                            <h6>Đến Ngày</h6>
                            <input name="end" type="date" class="form-control">
                        </div>
                        <div class="col mt-4">
                            <button class="btn btn-success" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </form>
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
    var list_ten =  <?php echo json_encode($list_ten); ?>;
    var list_tien =  <?php echo json_encode($list_tien); ?>;
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: list_ten,
      datasets: [{
        label: '# of Votes',
        data: list_tien,
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
</script>

@endsection
