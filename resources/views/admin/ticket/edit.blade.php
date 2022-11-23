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
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{route('admin.tickets.update',$ticket->id_ticket)}}" id="form-edit-ticket" method="post">
                    @csrf
                    <input type="hidden" name="id_bill_detail" value="{{$ticket->bill_detail_id}}">
                    <input type="hidden" name="id_bill" value="{{$ticket->bill_id}}">
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
                                        <input type="text" class="form-control" name="name_passenger" id="name_passenger" value="{{$ticket->name_passenger}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">SĐT khách hàng</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="phone_passenger" id="phone_passenger" value="{{$ticket->phone_passenger}}" style="color:red;font-weight:bold;">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Mã vé xe</label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control" id="code_ticket" value="{{$ticket->code_ticket}}" style="color:red;font-weight:bold;">
                                    </div>
                                </div>
                            @if($level == 2)
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Mã hoá đơn</label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control" id="code_bill" value="{{$ticket->code_bill}}" style="color:red;font-weight:bold;">
                                    </div>
                                </div>
                            @endif
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Chuyến đi</label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control" id="route_name" value="{{$ticket->route_name}}" style="color:red;font-weight:bold;">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Email khách hàng</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" name="email_passenger" id="email_passenger" value="{{$ticket->email_passenger}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Thời gian lên xe</label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control" id="departure_time" value="{{$ticket->departure_time}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Vị trí ghế</label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control" name="seat" id="seat" value="{{$ticket->seat_name}} Tầng {{$ticket->floor}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tổng tiền : </label>
                                    <div class="col-md-10">
                                        <input type="text" readonly class="form-control" name="price_tmp" id="price_tmp" value="{{$ticket->price}}">
                                        <input type="hidden" name="price" id="price" value="{{$ticket->bus_price*$ticket->quantity}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Điểm đón : </label>
                                    <div class="col-md-10">
                                        <select name="location" class="form-control">
                                            @foreach($arr_location as $key => $value)
                                                <option value="{{$key}}" @if($key == $ticket->id_location) selected @endif>{{$value}}</option>
                                            @endforeach
                                        </select>
    {{--                                    <input type="text" class="form-control" name="location" id="location" value="{{$ticket->location}}">--}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2" style="color:red;font-weight:bold;">Tình trạng thanh toán : </label>
                                    <div class="col-md-10">
                                        <label class="switch" for="checkbox">
                                            <input type="checkbox" name="status"
                                                   @if($ticket->status == 1) checked @endif id="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Cách Thanh Toán : </label>
                                    <div class="col-md-10" id="div_payment_method">
                                        <select name="payment_method" class="form-control" id="payment_method">
                                            @foreach($payment_method as $key => $value)
                                                <option value="{{$key}}" @if($key == $ticket->payment_method) selected @endif>{{$key}}</option>
                                            @endforeach
                                        </select>
                                        <br>
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
                                <input type="text" readonly class="form-control" value="{{$ticket->user_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Số tài xế : </label>
                            <div class="col-md-10">
                                <input type="text" readonly class="form-control" value="{{$ticket->user_phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Biển tài xế : </label>
                            <div class="col-md-10">
                                <input type="text" readonly class="form-control" value="{{$ticket->license_plate}}">
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <div class="mt-4 text-center">
                            <button class="btn btn-primary" type="submit" id="btn-submit">Sửa Thông Tin</button>
                            @if($level == 2)
                                <a class="btn btn-danger" href="{{route('admin.tickets.destroy', $ticket->id_ticket)}}">Xoá Vé Xe</a>
                            @endif
                            <a href="{{route('admin.tickets.index')}}" class="btn btn-warning" style="color:white;">Quay Lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script>
            function intToString(num) {
                num = num.toString().replace(/[^0-9.]/g, '');
                if (num < 1000) {
                    return num;
                }
                let si = [
                    {v: 1E3, s: "K"},
                    {v: 1E6, s: "M"},
                    {v: 1E9, s: "B"},
                    {v: 1E12, s: "T"},
                    {v: 1E15, s: "P"},
                    {v: 1E18, s: "E"}
                ];
                let index;
                for (index = si.length - 1; index > 0; index--) {
                    if (num >= si[index].v) {
                        break;
                    }
                }
                return (num / si[index].v).toFixed(2).replace(/\.0+$|(\.[0-9]*[1-9])0+$/, "$1") + si[index].s;
            }
            function loadFile(){
                let image = $("#div_payment_method");
                let payment_method = $("#payment_method").val();
                let img;
                let img_payment_method = $(".img_payment_method");
                if(img_payment_method){
                    $("img").remove(".img_payment_method");
                }
                switch (payment_method) {
                    case 'Momo':
                        img = `<img class="img_payment_method" src="{{asset('img/icon/momo.fc16949.png')}}" alt="Thanh toán momo" width="200" style="margin-top:15px;">`;
                        break;
                    case 'Thẻ Nội Địa':
                        img =`<img class="img_payment_method" src="{{asset('img/icon/napas.e513efd.png')}}" alt="Thanh toán thẻ ATM" width="200" style="margin-top:15px;">`;
                        break;
                    case 'Thẻ Quốc Tế':
                        img = `<img class="img_payment_method" src="{{asset('img/icon/jcb.99dcd7f.png')}}" alt="Thanh toán thẻ quốc tế" width="70" style="margin-top:15px;">
                                                <img class="img_payment_method" src="{{asset('img/icon/master.f966244.png')}}" alt="Thanh toán thẻ quốc tế" width="70" style="margin-top:15px;">
                                                <img class="img_payment_method" src="{{asset('img/icon/visa.af41b0e.png')}}" alt="Thanh toán thẻ quốc tế" width="70" style="margin-top:15px;">`;
                        break;
                    case 'Khác':
                        img=`<img id="img_payment_method" src="{{asset('img/icon/the-other-1.jpg')}}" alt="Thanh toán khác" width="200" style="margin-top:15px;">`;
                        break;
                }
                image.append(img);
            }
            $("#payment_method").change(function() {
                loadFile();
            });
            $("#quantity").change(function() {
                let bus_price = {{$ticket->bus_price}};
                let price = bus_price * this.value;
                let price_tmp = intToString(price);
                let input_price_tmp = $("#price_tmp");
                let input_price = $("#price");
                input_price_tmp.val(price_tmp);
                input_price.val(price);
            });
            $(document).ready(async function () {
                loadFile();

                //validation
                $("#form-edit-ticket").validate({
                    rules: {
                        name_passenger: {
                            required: true,
                        },
                        phone_passenger: {
                            required: true,
                        },
                        email_passenger: {
                            required: true,
                            email: true,
                        },
                        quantity: {
                            required: true,
                        },
                        price_tmp: {
                            required: true,
                        },
                        location: {
                            required: true,
                        },
                        payment_method: {
                            required: true,
                        }
                    },
                    messages:{
                        name_passenger: {
                            required:"Không được bỏ trống",
                        },
                        phone_passenger: {
                            required:"Không được bỏ trống",
                        },
                        email_passenger: {
                            required:"Không được bỏ trống",
                            email:"Email không hợp lệ",
                        },
                        price_tmp: {
                            required:"Không được bỏ trống",
                        },
                        location: {
                            required:"Không được bỏ trống",
                        },
                        payment_method: {
                            required:"Không được bỏ trống",
                        }
                    },
                    submitHandler:async function (form) {
                        if (check === true){
                            form.submit();
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
