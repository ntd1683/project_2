@extends('admin.layout.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .error {
            color: red !important;
        }
        .btn-primary {
            opacity:0.6;
        }
        .btn-primary:hover{
            opacity:1;
        }
        span.select2-container{
            z-index:10000 !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Xem Tuyến Đi</h4>
                </div>
                    <div class="card-body">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Được Ghim</label>
                                <div class="col-md-10">
                                    @if($route->pin == 1)
                                        <button type="button" class="btn btn-dark btn-lg">✓</button>
                                    @endif
                                    @if($route->pin == 0)
                                        <button type="button" class="btn btn-light btn-lg">✗</button>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tên</label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="name" id="name" placeholder="ví dụ : Đắk Lắk - Hồ Chí Minh" value="{{$route->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Thời Gian Đi</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="time" placeholder="Đơn vị giờ" value="{{$route->time}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Khoảng Cách</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="distance" id="distance" placeholder="Đơn vị km" value="{{$route->distance}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Ảnh hiển thị : </label>
                                <div class="col-md-10">
                                    <br>
                                    <img id="output" width="200" alt="Ảnh đã chọn" src="{{asset($images)}}"/>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <a class="btn btn-success" href="{{route('admin.routes.edit',$route)}}">Sửa</a>
                                <a href="{{route('admin.routes.index')}}" class="btn btn-warning" style="color:white;">Quay Lại</a>
                            </div>
                    </div>
            </div>
        </div>
    </div>
{{--    Nợ sau này làm :3 --}}
{{--    @todo làm bảng show tài xế <3 --}}
    @if($check_route_driver_car == 1)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <h1>Thông tin xe và tài xế</h1>
                    </div>
                    <div class="table-responsive">
                        <!-- thiếu class datatable-->
                        <table class="table table-hover table-center mb-0" id="table-index" style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên tài xế</th>
                                <th>Biển số xe</th>
                                <th>Loại xe</th>
                                <th>Loại ghế</th>
                                <th>Giá tiền</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
        <script>
            $(document).ready(function(){
                let table = $('#table-index').DataTable({
                    destroy: true,
                    dom: 'ltrp',
                    lengthMenu:[5,10,20,25,50,100],
                    select: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.route_driver_car.api',$route->id) !!}/',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name_driver', name: 'name_driver'},
                        {data: 'license_plate_car', name: 'license_plate_car'},
                        {data: 'category_car', name: 'category_car'},
                        {data: 'seat_type_car', name: 'seat_type_car'},
                        {data: 'price', name: 'price'},
                    ],
                });
            });
        </script>
    @endpush
@endsection
