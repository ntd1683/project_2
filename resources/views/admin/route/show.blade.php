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
                    <div class="card-body"> readonly
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
                                    <img id="output" width="200" alt="Ảnh đã chọn"/>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <a class="btn btn-success" href="{{route('admin.routes.index',$route)}}">Sửa</a>
                                <a class="btn btn-danger" href="{{route('admin.routes.index',$route)}}">Xoá</a>
                                <a href="{{route('admin.routes.index')}}" class="btn btn-link">Quay Lại</a>
                            </div>
                    </div>
            </div>
        </div>
    </div>
{{--    Nợ sau này làm :3 --}}
{{--    @todo làm bảng show tài xế <3 --}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row justify-content-center">--}}
{{--                        <h1>Thông tin xe và tài xế</h1>--}}
{{--                    </div>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <!-- thiếu class datatable-->--}}
{{--                        <table class="table table-hover table-center mb-0" id="table-index" style="text-align: center">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>#</th>--}}
{{--                                <th>Loại xe</th>--}}
{{--                                <th>Loại ghế</th>--}}
{{--                                <th>Tên tài xế</th>--}}
{{--                                <th>Giá tiền</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script>
        </script>
    @endpush
@endsection
