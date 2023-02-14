@extends('layout.master')
@push('css')
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.toast.min.css')}}">
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #33313B !important;
            border: 0px !important;
            margin-left: 18px !important;
        }
        .border-beauty{
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .booking-success-wrapper {
            display: flex;
            margin-top: 15px;
        }
        .booking-success-body, .cancel-ticket-body, .payment-success-body {
             padding: 15px;
             margin-bottom: 5px;
        }
        .hotline-bold, .phone-bold {
            font-weight: 700;
            color: #585859;
        }
        .arrive-section .arrive-section-title, .pickup-section .pickup-section-title {
            font-weight: 700;
            font-size: 18px;
            color: #144299;
        }
        .booking-instruction-title, .cancel-section .cancel-section-title, .checkin-instruction-title {
              font-size: 18px;
              font-weight: 700;
              color: #144299;
              padding-bottom: 5px;
        }
        .arrive-section .arrive-address-title, .pickup-section .pickup-address-title {
            font-weight: 700;
            font-size: 16px;
        }
        .table-info .info-label {
            font-weight: 400;
            font-size: 11px;
            line-height: 22px;
            color: #7f7f7f;
        }
        .ticket-box .info-label {
            font-size: 14px!important;
        }
        .left-container {
            width: 70%;
            box-sizing: border-box;
            margin-right: 15px;
        }
        .booking-success-noti-title {
            font-size: 22px;
            font-weight: 700;
            color: #484848;
            margin-bottom: 10px;
            padding-left: 15px;
        }
        .booking-success-checking-line {
            font-size: 16px;
        }
        .arrive-section, .pickup-section {
            line-height: 28px;
        }
        .right-container {
            width: 30%;
        }
        .ticket-box {
            padding: 10px;
            margin-top: 40px;
        }
        .trip-info {
            line-height: 24px;
            margin-top: 15px;
            padding: 10px;
        }
        .ticket-box .ticket-info-title, .trip-info .trip-info-title {
            font-size: 16px;
            font-weight: 700;
            color: #484848;
            margin-bottom: 16px;
        }
        .payment-method, .payment-status {
            font-size: 15px;
            color: #767676;
            margin-top: 5px;
        }
        .payment-method-content {
             font-size: 15px;
        }
        .ticket-box-price {
            margin-top: 5px;
            font-weight: 600;
        }
        .ticket-box-price, .ticket-box-seat-num {
            font-size: 15px;
        }
        .trip-info .total-price-label {
            font-weight: 700!important;
        }
        .total-price-amount {
            font-size: 18px;
            font-weight: 700;
            color: #0060c4;
        }

        .button_pay {
            height: 47px;
            font-family: 'Roboto', sans-serif;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            font-weight: 500;
            color: #000;
            background-color: #fff;
            border: none;
            border-radius: 45px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease 0s;
            cursor: pointer;
            outline: none;
        }

        .button_pay:hover {
            background-color: #2EE59D;
            box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
            color: #fff;
            transform: translateY(-7px);
        }
    </style>
@endpush
@section('content')
    <section class="ftco-section" style="padding: 3em 0em 0em 0em !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Thông Tin Vé</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pb ftco-no-pt" style="margin-bottom:25px;">
        <div class="container">
            <div class="row">
                <div class="booking-success-wrapper">
                    <div class="left-container">
                        <div class="booking-success-noti-title">
                            @if($ticket->status !== 0)
{{--                            Thanh toán thành công--}}
                            <span role="img" aria-label="check-circle"
                                  class="anticon anticon-check-circle"
                                  style="color: rgb(80, 230, 85); font-size: 25px;">
                                <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="check-circle"
                                    width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                    <path d="M699 353h-46.9c-10.2 0-19.9 4.9-25.9 13.3L469 584.3l-71.2-98.8c-6-8.3-15.6-13.3-25.9-13.3H325c-6.5 0-10.3 7.4-6.5 12.7l124.6 172.8a31.8 31.8 0 0051.7 0l210.6-292c3.9-5.3.1-12.7-6.4-12.7z"></path>
                                    <path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"></path>
                                </svg>
                            </span>
                            <h3 style="display:inline-block;font-weight: bold;">Thanh toán thành công</h3>
                            @endif
                            @if($ticket->status === 0)
{{--                            Chưa thanh toán--}}
                            <span role="img" aria-label="check-circle"
                                  class="anticon anticon-check-circle"
                                  style="color: rgb(255, 0, 0); font-size: 25px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </span>
                            <h3 style="display:inline-block;font-weight: bold;">Chưa được thanh toán</h3>
                            @endif
                        </div>
                        <div class="white-bg payment-success-body border-beauty">
                            <div class="booking-success-checking">
                                <div class="booking-success-checking-line">Chúng tôi đã gửi thông tin vé đến email: <span class="phone-bold"
                                    >{{$ticket->email_passenger}}</span></div>
                                <div class="booking-success-checking-line">15 phút sau khi thanh toán thành công, nếu
                                    quý khách vẫn chưa nhận được tin nhắn, vui lòng liên hệ chúng tôi qua số điện thoại:
                                    <span class="hotline-bold">02623 815815</span></div>
                            </div>
                            <hr>
                            <div>
                                <div class="checkin-instruction-title">Hướng dẫn lên xe</div>
                                <div class="booking-success-payment-step">Bạn cần ra điểm đón trước 15 phút, đưa email xác nhận thanh toán cho nhân viên văn phòng vé để đổi vé giấy.
                                </div>
                                <div class="booking-success-payment-step">Khi lên xe, bạn xuất trình vé giấy (trong email) cho tài xế
                                    hoặc phụ xe.
                                </div>
                            </div>
                            <hr>
                            <div class="pickup-section">
                                <div class="pickup-section-title">Điểm đón</div>
                                <div class="pickup-address-title">{{$ticket->location}}</div>
                                <div class="pickup-time">Đón lúc: <span class="bold-text">{{$ticket->departure_time}}</span></div>
                            </div>
                            <hr>
                            <div class="pickup-section">
                                <div class="pickup-section-title">Điểm trả</div>
                                <div class="pickup-address-title">{{$ticket->city_name_end}}</div>
                                <div class="pickup-time">Đón lúc: <span class="bold-text">{{add_hour(date("H:i", strtotime($ticket->departure_time)),$ticket->time)}}</span></div>
                            </div>
                            <hr>
                            <div class="cancel-section">
                                <div class="cancel-section-title">Hướng dẫn đổi trả / hủy vé</div>
                                <div class="cancel-section-step">Để được hỗ trợ đổi trả / hủy vé, vui lòng liên hệ chúng
                                    tôi qua số điện thoại: <span class="hotline-bold">02623 815815</span></div>
                            </div>
                        </div>
                        @if($ticket->status === 0)
                        <div style="text-align: center;margin-top:15px">
                            <form action="{{route('applicant.payment_methods')}}" method="get">
                                <input type="hidden" name="code" value="{{$code_bill}}">
                                <button class="button_pay">Thanh Toán Ngay</button>
                            </form>
                        </div>
                        @endif
                    </div>
                    <div class="right-container">
                        <div class="ticket-box white-bg border-beauty">
                            <div class="ticket-info-title">Thông tin vé</div>
                            <div class="table-info">
                                <div class="info-label">Số lượng ghế</div>
                                <div class="value">{{$ticket->quantity}}</div>
                                <hr>
                                @foreach($arr_ticket as $each_ticket)
                                <div class="info-label">Ghế : <b>{{$each_ticket['name_seat']}}</b></div>
                                <div class="info-label">Mã vé</div>
                                <div class="value">{{$each_ticket['code_ticket']}}</div>
                                <hr>
                                @endforeach
                                <div class="info-label">Họ tên</div>
                                <div class="value">{{$ticket->name_passenger}}</div>
                                <hr>
                                <div class="info-label">Số điện thoại</div>
                                <div class="value">{{$ticket->phone_passenger}}</div>
                                <hr>
                                <div class="info-label">Email</div>
                                <div class="value">{{$ticket->email_passenger}}</div>
                                <hr>
                                <div class="info-label">Nhà xe</div>
                                <div class="value">Thu Đức</div>
                                <hr>
                                <div class="info-label">Tuyến đường</div>
                                <div class="value">{{$ticket->route_name}} (TĐ)</div>
                            </div>
                        </div>
                        <div class="trip-info white-bg border-beauty">
                            <div class="trip-info-title">Thông tin giao dịch</div>
                            <div class="payment-method">Hình thức</div>
                            <div class="payment-method-content">Chuyển khoản "{{$ticket->payment_method}}"</div>
                            <div class="payment-status">Trạng thái</div>
                            <div class="payment-status-content">Đã thanh toán</div>
                            <hr>
                            <div class="ticket-fare">Tổng tiền :</div>
                            <div class="group-fare-item">
                                <div class="ticket-box-price">≈{{number_shorten($ticket->buses_price)}}&nbsp;₫</div>
                                <div class="ticket-box-seat-num">Số lượng ghế: {{$ticket->quantity}}</div>
                                <hr>
                            </div>
                            <div class="total-price-label">Tổng tiền</div>
                            <div class="total-price-amount"><span>{{$ticket->bill_price}}₫</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('js')
        <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script>
            $(function() {
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                $.toast({
                    heading: 'Error',
                    text: '{{ $error }}',
                    icon: 'error',
                    position: 'top-right',
                    showHideTransition: 'slide',
                });
                @endforeach
                @endif
                @if (session()->has('success'))
                $.toast({
                    heading: 'Import Success',
                    text: '{{session()->get('success')}}',
                    icon: 'success',
                    position: 'top-right',
                    showHideTransition: 'slide',
                });
                @endif
                @if (session()->has('error'))
                $.toast({
                    heading: 'Error',
                    text: '{{session()->get('error')}}',
                    icon: 'error',
                    position: 'top-right',
                    showHideTransition: 'slide',
                });
                @endif
            });
        </script>
    @endpush
@endsection
