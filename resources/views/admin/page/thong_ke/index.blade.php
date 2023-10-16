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
                        <div class="col">
                            <h6>Từ Ngày</h6>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col">
                            <h6>Đến Ngày</h6>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col">
                            <h6>Loại Thống Kê</h6>
                            <select class="form-control">
                                <option value="0">Chọn</option>
                            </select>
                        </div>
                        <div class="col mt-4">
                            <button class="btn btn-success">
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
@endsection
@section('js')
@endsection
