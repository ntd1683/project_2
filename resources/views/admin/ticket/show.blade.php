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
                    <h3 class="card-title">Xem Vé Xe</h3>
                </div>
                <div class="card-header">
                    <h5 class="card-title">Thông tin Vé Xe</h5>
                </div>
                    <div class="card-body">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tên khách hàng</label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="name_passenger" id="name_passenger" value="{{$ticket->name_passenger}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">SĐT khách hàng</label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="phone_passenger" id="phone_passenger" value="{{$ticket->phone_passenger}}" style="color:red;font-weight:bold;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Mã vé xe</label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="code_ticket" id="code_ticket" value="{{$ticket->code_ticket}}" style="color:red;font-weight:bold;">
                                </div>
                            </div>
                        @if($level == 2)
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Mã chuyến xe</label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="code_ticket" id="code_ticket" value="{{$ticket->code_bill}}" style="color:red;font-weight:bold;">
                                </div>
                            </div>
                        @endif
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Chuyến đi</label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="route_name" id="route_name" value="{{$ticket->route_name}}" style="color:red;font-weight:bold;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Email khách hàng</label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="email_passenger" id="email_passenger" value="{{$ticket->email_passenger}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Thời gian lên xe</label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="route_name" id="route_name" value="{{$ticket->departure_time}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Vị trí ghế</label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="route_name" id="route_name" value="{{$ticket->seat_name}} Tầng {{$ticket->floor}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tổng tiền : </label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="route_name" id="route_name" value="{{$ticket->price}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Điểm đón : </label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="route_name" id="route_name" value="{{$ticket->location}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" style="color:red;font-weight:bold;">Tình trạng thanh toán : </label>
                                <div class="col-md-10">
                                    @if($ticket->status == 1)
                                        <button type="button" class="btn btn-dark btn-lg"style="background-color:#27c24c;border-color: #27c24c;">✓</button>
                                        <span style="font-size: 20px;">Đã được thanh toán</span>
                                    @endif
                                    @if($ticket->status == 0)
                                        <button type="button" class="btn btn-light btn-lg" style="background-color:#ff0000;border-color: #ff0000;">✗</button>
                                        <span style="font-size: 20px;">Chưa được thanh toán </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Cách Thanh Toán : </label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="route_name" id="route_name" value="{{$ticket->payment_method}}">
{{--                                    <div>--}}
                                        @switch($ticket->payment_method)
                                            @case('Khác')
                                                <img src="{{asset('img/icon/the-other-1.jpg')}}" alt="Thanh toán khác" width="200" style="margin-top:15px;">
                                            @break
                                            @case('Momo')
                                                <img src="{{asset('img/icon/momo.fc16949.png')}}" alt="Thanh toán MoMo" width="200" style="margin-top:15px;">
                                            @break
                                            @case('Thẻ Nội Địa')
                                                <img src="{{asset('img/icon/napas.e513efd.png')}}" alt="Thanh toán thẻ ATM" width="200" style="margin-top:15px;">
                                            @break
                                            @case('Thẻ Quốc Tế')
                                                <img src="{{asset('img/icon/jcb.99dcd7f.png')}}" alt="Thanh toán thẻ quốc tế" width="70" style="margin-top:15px;">
                                                <img src="{{asset('img/icon/master.f966244.png')}}" alt="Thanh toán thẻ quốc tế" width="70" style="margin-top:15px;">
                                                <img src="{{asset('img/icon/visa.af41b0e.png')}}" alt="Thanh toán thẻ quốc tế" width="70" style="margin-top:15px;">
                                            @break
                                        @endswitch
{{--                                    </div>--}}
                                </div>
                            </div>
                            @if($ticket->status == 1 && $level == 2)
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Người duyệt thanh toán </label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control" name="user_id" id="route_name" value="{{$ticket->name_staff}}">
                                    </div>
                                </div>
                            @endif
                    </div>
                <hr>
                <div class="card-header">
                    <h5 class="card-title">Thông tin Tài Xế</h5>
                </div>
                <div class="card-header">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Tên tài xế : </label>
                        <div class="col-md-10">
                            <input type="text" readonly class="form-control" name="route_name" id="route_name" value="{{$ticket->user_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Số tài xế : </label>
                        <div class="col-md-10">
                            <input type="text" readonly class="form-control" name="route_name" id="route_name" value="{{$ticket->user_phone}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Biển tài xế : </label>
                        <div class="col-md-10">
                            <input type="text" readonly class="form-control" name="route_name" id="route_name" value="{{$ticket->license_plate}}">
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="mt-4 text-center">
                        <a class="btn btn-success" href="{{route('admin.tickets.edit',$ticket->id_ticket)}}">Sửa</a>
                        <a href="{{route('admin.tickets.index')}}" class="btn btn-warning" style="color:white;">Quay Lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
    @endpush
@endsection
