@extends('layout.master')
@push('css')
        <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        @if($request->step == 3)
{{--            <link rel="stylesheet" href="{{asset('css/b00274d.css')}}">--}}
            <link rel="stylesheet" href="{{asset('css/2196462.css')}}">
            <link rel="stylesheet" href="{{asset('css/7c328b7.css')}}">
        @endif
    <style>
        @charset "UTF-8";
        @if($request->step == 3)
            #terms-policies-checkbox:hover,#id-terms-and-policies:hover,#id-term-text:hover{
                cursor: pointer;
            }

            .input-title[data-v-46398b4b] {
                text-align:left;
            }
        @endif
        .input-group .form-control {
            height: 40px !important;
            margin-right: 7px;
        }

        .error{
            color: red;
        }

        input{
            text-align:center;
        }

        a:hover{
            cursor: pointer;
        }

        .multi-steps > li.is-active ~ li:before, .multi-steps > li.is-active:before {
            content: counter(stepNum);
            font-family: inherit;
            font-weight: 700;
        }
        .multi-steps > li.is-active ~ li:after, .multi-steps > li.is-active:after {
            background-color: #ededed;
        }

        .multi-steps {
            display: table;
            table-layout: fixed;
            width: 100%;
        }
        .multi-steps > li {
            counter-increment: stepNum;
            text-align: center;
            display: table-cell;
            position: relative;
            color: tomato;
        }
        .multi-steps > li:before {
            content: "";
            content: "✓;";
            content: "𐀃";
            content: "𐀄";
            content: "✓";
            display: block;
            margin: 0 auto 4px;
            background-color: #fff;
            width: 36px;
            height: 36px;
            line-height: 32px;
            text-align: center;
            font-weight: bold;
            border-width: 2px;
            border-style: solid;
            border-color: tomato;
            border-radius: 50%;
        }
        .multi-steps > li:after {
            content: "";
            height: 2px;
            width: 100%;
            background-color: tomato;
            position: absolute;
            top: 16px;
            left: 50%;
            z-index: -1;
        }
        .multi-steps > li:last-child:after {
            display: none;
        }
        .multi-steps > li.is-active:before {
            background-color: #fff;
            border-color: tomato;
        }
        .multi-steps > li.is-active ~ li {
            color: #808080;
        }
        .multi-steps > li.is-active ~ li:before {
            background-color: #ededed;
            border-color: #ededed;
        }

        .route-option[data-v-008a65cb] {
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #dde2e8;
            margin-bottom: 20px
        }

        .route-option.selected[data-v-008a65cb] {
            border: 2px solid #f2754e
        }

        .route-option .header[data-v-008a65cb] {
            font-size: 24px;
            font-weight: 500
        }

        .route-option .header>img[data-v-008a65cb] {
            width: 28px;
            height: 7px;
            margin-bottom: 6px
        }

        .route-option .utilities[data-v-008a65cb] {
            float: right
        }

        .route-option .utilities img[data-v-008a65cb] {
            width: 16px;
            height: 16px
        }

        .route-option .label[data-v-008a65cb] {
            color: #111;
            margin: 8px 0 16px;
            font-size: 15px;
            font-weight: 500;
            min-width: 200px;
            height: 28px;
            border-radius: 16px;
            padding: 5px 12px;
            display: inline-block;
            background-color: rgba(99, 114, 128, .1)
        }

        .route-option .label>.dot[data-v-008a65cb] {
            display: inline-block;
            width: 6px;
            border-radius: 3px;
            height: 6px;
            opacity: .3;
            margin: 3px 12px;
            background-color: #000
        }

        .route-option .next-button>img[data-v-008a65cb] {
            width: 24px;
            height: 24px;
            margin-left: 36px
        }

        .route-line-container[data-v-008a65cb] {
            display: flex;
            margin-bottom: 20px
        }

        .route-line-container>.route-line-list[data-v-008a65cb] {
            flex: 1
        }

        .route-line-container>.action[data-v-008a65cb] {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            color: #01613d;
            font-size: 13px;
            font-weight: 500;
            width: 34px
        }

        .route-line-container>.action img[data-v-008a65cb] {
            width: 22px;
            height: 22px;
            margin-bottom: 5px
        }

        .route-line[data-v-008a65cb] {
            font-size: 15px;
            color: #637280;
            position: relative;
            border-left: 2px dotted #c0c6cc;
            padding-left: 22px;
            margin-left: 8px;
        }

        .route-line.bold[data-v-008a65cb] {
            font-weight: 500;
            color: #111
        }

        .route-line>div[data-v-008a65cb] {
            font-size: 13px;
            color: #00613d;
            line-height: 48px
        }

        .route-line[data-v-008a65cb]:last-child {
            border-left: 2px dotted #fff
        }

        .route-line>img[data-v-008a65cb] {
            width: 16px;
            height: 16px;
            top: 0;
            left: -9px;
            position: absolute
        }

        .route-line-container>.action .selected {
            color: #ef5222;
        }

        @media screen and (max-width:767px) {

            .route-option .label>.dot[data-v-008a65cb] {
                margin: 3px;
            }
        }

        .div-hide{
            display: none
        }

        .div-block{
            display: block;
        }

    </style>
@endpush
@section('content')
    @foreach($errors as $error)
        {{$error}}
    @endforeach
    <!-- Ảnh bìa -->
    <section class="hero-wrap hero-wrap-2 js-fullheight"
             style="background-image:url({{asset('images/background_2.jpg')}})" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb-3 bread">Đặt Vé Xe</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end Ảnh bìa -->
    <section class="ftco-section" style="padding:0px !important;">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    @if($request->step == 1|| !isset($request->step))
                    <h2 class="mb-4">Lộ Trình Phổ Biến</h2>
                     @endif
                    @if($request->step == 2)
                    <h2 class="mb-4">Xác Nhận Lộ Trình</h2>
                    <p>{{$arr_route['name']}}</p>
                     @endif
                    @if($request->step == 3)
                    <h2 class="mb-4">Thông Tin Khách Hàng</h2>
                     @endif
                </div>
            </div>
            @if($request->step == 1|| !isset($request->step))
            <section class="ftco-section ftco-no-pt" style="padding-bottom:0px !important;">
                <div class="container">
                    <div class="row">
                        @foreach($routes as $route)
                            <div class="col-md-4 ftco-animate">
                                <div class="project-wrap">
                                    <a onclick="book_ticket({{$route->city_start_id}},{{$route->city_end_id}})" class="img"
                                       style="background-image:url({{asset($route->img)}})"></a>
                                    <div class="text p-4">
                                        <a onclick="book_ticket({{$route->city_start_id}},{{$route->city_end_id}})"><span class="price" style="text-align:center">Từ {{$route->price}} Đ/Vé</span></a>
                                        {{--                        <span class="days">Ngày Thường</span>--}}
                                        <h3><a onclick="book_ticket({{$route->city_start_id}},{{$route->city_end_id}})">{{$route->name}}</a></h3>
                                        <p class="location" style="display:inline-block"><span class="fas fa-location-arrow"></span> {{$route->distance}}km</p>
                                        <p class="location" style="display:inline-block;margin-left: 10px;"><span class="fas fa-stopwatch"></span> {{$route->distance}}h</p>
                                        <ul>
                                            <li><span class="fas fa-wifi"></span></li>
                                            <li><span class="fas fa-fan"></span></li>
                                            <li><span class="fas fa-prescription-bottle"></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif
            <div class="row">
                <div class="container-fluid ftco-animate">
                    <br /><br />
                    <ul class="list-unstyled multi-steps">
                        <li
                            @if($request->step == 1|| !isset($request->step))
                            class="is-active"
                            @endif
                        >Chọn Tuyến</li>
                        <li
                            @if($request->step == 2)
                            class="is-active"
                            @endif
                        >Xác Nhận Lộ Trình</li>
                        <li
                            @if($request->step == 3)
                            class="is-active"
                            @endif
                        >Thông Tin Khách Hàng</li>
                        <li
                            @if($request->step == 4)
                            class="is-active"
                            @endif
                        >Thanh Toán</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @if($request->step == 1|| !isset($request->step))
        <br><br><br><br><br><br>
    <section class="ftco-section" style="padding:0px !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-wrap-1 ftco-animate p-4" style="border-radius:15px;box-shadow: 5px 5px #847979c4;">
                        <form action="{{route('applicant.book_ticket')}}" method="get" class="search-property-1">
                            <input type="hidden" name="step" value="2">
                            <div class="row">
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Nơi đi</label>
                                        <div class="form-field">
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select name="city_start" id="city_start" class="form-control">
                                                    <option value="-1" selected>Chọn nơi đi</option>
                                                    @foreach($city_start as $key => $value)
                                                        <option value="{{$key}}"
                                                        @if($key == $request->city_start)
                                                            selected
                                                        @endif
                                                        >{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Nơi đến</label>
                                        <div class="form-field">
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select name="city_end" id="city_end" class="form-control">
                                                    <option value="-1">Chọn nơi đến</option>
                                                    @foreach($city_end as $key => $value)
                                                        <option value="{{$key}}"
                                                            @if($key == $request->city_end)
                                                                selected
                                                            @endif
                                                        >{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Ngày khởi hành</label>
                                        <div class="form-field">
                                            <div class="icon"><span class="ion-ios-calendar"></span></div>
                                            <input type="text" id="departure-day" name="departure_time" class="form-control checkout_date" placeholder="Chọn ngày khởi hành"
                                            @if(isset($request->departure_time))
                                                value="{{$request->departure_time}}"
                                            @endif
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg align-self-end">
                                    <div class="form-group">
                                        <div class="form-field">
                                            <input type="submit" value="Tìm vé xe" class="form-control btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
{{--    {{dd($request->step==2)}}--}}
    @if($request->step===2&&!empty($arr_bus))
    <?php $check_tmp = 0 ?>
    @foreach($arr_bus as $each_bus)
    <section class="ftco-section" style="padding:0px !important;text-align:center">
        <div class="route-option" data-v-008a65cb="" id="select_route_{{$check_tmp}}">
            <div class="header" data-v-008a65cb="">
                <p>Các giờ xuất phát : {{date("H:i", strtotime($each_bus->departure_time[0]))}}
                    @foreach($each_bus->departure_time as $key=>$value)
                        @if($key != 0)
                        - {{date("H:i", strtotime($each_bus->departure_time[$key]))}}
                        @endif
                    @endforeach
                     </p>
{{--                <img alt="fromto" width="28" height="7" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADgAAAAOCAYAAAB6pd+uAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAOKADAAQAAAABAAAADgAAAAAjNiV1AAABjklEQVRIDWNgGGQgraTRO7OiXZBazmKilkHUMuffPwaFX39+ZaSXN+lTw8xB50FGRgYmxn8MbH9//w9ILmoMLezr46TEo4POg/8ZgV6EAiBD68uTL5nAJKsEEyOVZiZVA63VG1nYWzIwMHIg2cP+7+9ffWMrRw4/d4eHBw4c+IckR5A56GIQGGtY3fT/P4PFk0+MqSlVreIEfYWkAKthSPJ0ZyInUSyWizH+/JuaVNJk+f//f3hSxqIOLjToPMgALGTgrsPCAHqMmenff7fUsubY3IYGPixKUITwGoaikk4cYAlKnJv+/lf88YUxM7W8SRuf04gzDJ8JVJYjkERRbPv/j4Hj/+//IamFjYG5kyaxo0hCOYwpRY312CSGntj/j0ysHOtmdVY8Qnb7oItBZMeRxmbk//f7ZyKwceAcumoVvPobRh6EBAewaLXhP3kjOa24QQQkwmxk6egAkRqcJDBP/mcAImDpCkQgBgMom/4DYmBFAaorgMUSAwMEMzL+BSr5BxTkBNabeqZ2Tp8BQTlvqFxYe+QAAAAASUVORK5CYII=" data-v-008a65cb="">--}}
{{--                20:15--}}
                <div class="utilities" data-v-008a65cb="">
                    <img alt="water utilitie" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAhUExURUdwTKOstKKstKOss6OrtKOttKOstKautaOttaazuqKrs9iuYewAAAAKdFJOUwBTqMbYepIsaxVu35VTAAAAaUlEQVQoz2NgIBIICgpKIvMZV61atQJdYCmyAKexsbE5fkOFlJQCkPkcXqtWuSILaAENXWWAagmKNWxggcUIASawwBI8AhxggWUIAXawwEI8hrKCBRbRQssiUpxOtgCSwzgFQUCcyGgHAESfV/tGvoBwAAAAAElFTkSuQmCC" width="16" height="16" data-v-008a65cb="">
                    <img alt="tissue utilitie" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAbUExURUdwTKSttKOstqevuKKstKOstKOstKOstKKrs1QBF0QAAAAIdFJOUwBxUB7irc+RSBqH+QAAAHtJREFUKM9jYKAFUFJSRnCMlJQYOjraDGB85oyODqBAh6MgFIh1QARQAEMEKr+VgR1VIIDBA0QVKSkpqYMFWhgg6kBAAmKGCJBoBAuYgfiODKZwAQagKzqCwVqgAmA9mAIYWjAMxbAWw2EYTsfwHIb3sQQQWhBiBDItAABMgnXv5SJBWwAAAABJRU5ErkJggg==" width="16" height="16" data-v-008a65cb="">
                    <img alt="form utilitie" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAtUExURUdwTKvMzKWvt6Oss6eyuaSstqOttaKstKOstKOstKOstKWtt6OstKOstKKrs+TeAR8AAAAOdFJOUwAGI/ATRmDhx7miNot2T+ML3AAAANBJREFUKM9jYKAZYNx2as1VBwSfdfE7IHiRCONzz3sHBs8vQtWfA3Ie24HUKIAFPICs2wKMakB9ZiA+U927lxtADJbD794lAGn3d4+BlJAKUKrv3SOgQNy7agbGG+/eWQUwSL17ChRwfq7AkA6y5KUC4+EFIK0hDDwQa03hDlsHdEMz0OoNUD7bu3dvHRg0372bABXgffcc5KI8uABLXQvYR50KMDOEBBgyp6H6H2jMARQB9nfvHqIIyL0DuxoBON+9K0ARYKqDuwoKREMY6AkAd2hhK9YYGPUAAAAASUVORK5CYII=" width="16" height="16" data-v-008a65cb="">
                </div>
            </div>
            <div class="label" data-v-008a65cb="">
                {{number_shorten($each_bus->price)}} <span class="dot" data-v-008a65cb=""></span>
                {{$each_bus->seat_type_car}} <span class="dot" data-v-008a65cb=""></span> <span data-v-008a65cb="">Còn {{$each_bus->number_seat}} chỗ</span>
            </div>
            <div class="route-line-container" data-v-008a65cb="">
                <div class="route-line-list" data-v-008a65cb="">
                    <div class="route-line bold" data-v-008a65cb=""><img alt="pickup-bold" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAn1BMVEUAAAAAAAAAgAAAVVUAbUkAYEAAYkUAYkMAYjwAYD4AYTwAYD0AYT4AYTwAYT0AYT0AYT0AYT0AYT0AYT0AYDwAYT0AYT0AYT0AYD0AYT3////+/v79/f39/fzv8/HV4dzL29WTr6I0d1orakwfZUQWY0IPY0APYT4HYj8MXzwGYT4DYT0AYjwAYT0AYTwAYD0AYDwAXTYAXDAAWS0ASwCRAZr+AAAAGnRSTlMAAQIDBxgaIi9Se5eZwsja4Orx9/r7/P39/ifZSUoAAAFmSURBVHjahVMJjoMwDHS37fY+odBAuQrlTmKO/79tTUBVVWmVERLKzCSxHRtGzOYAy83+eDGMy3G/WQLMZ/CBH4DV7iRwgjjtVgP5xhwW2yvi3WKMc8asO+J1uyD6vf/3wPFmC8klgUth35AffkmY9q/P0mTIJcoJHJkpz2uSxv1nNDnpH6CliWd1xgwWBznq3w55WJA8hy0nfSKrsqwmMxK9JRlWV2QDxTnmSdY0WZIjH9ZEXylb2OFt0tOib+O47Yt0dJCwA1ie0Obq/FdXR6Hvh1HdvVBRNp6WsBF3ofS0ewaOQvDsUuUgaQN7tIb8MS/qwPEervvwnKAuchW2hXs4IlPHJX3keK7j0uc5UZ8okuERLsgkocra0Hk4LoF+YZtVRCLDCxhj1mUT+0pWFj9uyrEyhtagv4KCFP8FKShIbZraQmlLrX0s7XNrG0bbcrqm1bX99+AIsqD4GBz96OmHVzv+f2mSel1r7cqaAAAAAElFTkSuQmCC" width="16" height="16" data-v-008a65cb="">
                        <div data-v-008a65cb="">
                            Xe tuyến: {{$arr_route['distance']}} km - {{$arr_route['time']}} tiếng
                        </div>
                    </div>
                    <div class="route-line bold" data-v-008a65cb="">
                        <img alt="destination-bold" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAmCAMAAACS/WnbAAAA51BMVEUAAAD/AAD/ZjPmTRrvUCDwWh7yTSbzUSP2VSbwUiXwUCT4VSPxUyLyUSLwVSPxVSbyVSTtUSTzUiHuVCPvVSPxUyPxVCPxUyPvUyPwUyLwUyPxUyPwUyPwUiLxUiLvUyPwUiLwVCLvVCLwUyLvUyLvUiLwUyPwUiLvUyPvUyLwUiPwUyLvUiLvUiLwUiLvUyLwUiLvUiPxUyLwUiLwUyLvUiLwUiLvUyLvUyLwUyLvUiLwUiPvUiPvUiL////++ff83tX71sv1knTxZjzwXC70VCPyUyLxUyLwUiLvUiLvUSHvTx/vTh3N/rktAAAAPnRSTlMAAQUKEBEUFhsiIyQlJjM2OTk+SWBsbW5ueHuEhIiPk56rrra8xcfJ1dXW2Nna3OHi5efo6u3v9Pb5+vv7/K+Q08cAAAFUSURBVHjafdPllsIwEAXgu8YKrOHu7u5umQHe/3kWerophabfz9w5k2RyAunxwxPPlobDUjbu+XjEne9shwQRM5GgTvYbZp+pHZvsUp+44m0JviFaXki+CVuY+KDzT9nS1A+Ne8AKAzcuKsQKVMFZWLCSCAOOKhsOx9PpeGBD1YHfsRFv16vFYrXeGiXjX0SFzDfLuWa5kRUiijyxbqvlWsWWdZRHWzZYz6W1bNHGiHXH1VxaHVk3Qp91p8VcWpxY10eF7AqogjTZbUFpBPd2h9wH8TO2u+b4B46a3aBqDiBJ6lFTEoBrpn6smQtnCcEKIoGL9y4rdN+hiQlFgxh0RWILVMS/rx5b6H1BCrCFAAwPkfufFXnAlZccsQnlXmDyWiZTXn7FDVedWKK6C3ecDZJ5wwkLzqpgjag6YemtILS88AaF54wgEplnKD2Fms3Qk2npDzuS7aPkEDnLAAAAAElFTkSuQmCC" width="16" height="19" data-v-008a65cb="">
{{--                        VP Buôn Ma Thuột--}}
                    </div>
                </div>
                <div class="action" data-v-008a65cb="" onclick="select_checkbox({{$check_tmp}})">
                    <img alt="checkbox" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAAtFBMVEUAAAAAgICAgL+Upa2Pl5+bo6uVoKuWoKqfqLGWn6mapK2Zo62dpq+apa6dp7Cep6+ep7CbprCdp7Ccpa+cpq+bpq6ep7Gcpq+dp7Ccp7Cbpq+dprD////+///+/v76+vv6+vr4+fn29/f19vfx8vTs7vDr7e/i5efa3uHa3eDV2d3U2d3S1tvM0ta7wsixucCvt76psrqmrregqrKgqbKfqLKeqLGdp7CdprCcpq+bpa+bpa4Vzj1GAAAAHHRSTlMAAgQfID1GS1JoeX2Mp7m6v8zT4uPk7vP4+/v86VxdYgAAAX1JREFUeNqVldmSgjAQRaO44bjhrpNBZWBAQSBsmab//7/GoqgpXJDkPJ+HTtK5lzygdNXxfL3drudjtauQd/SnC8g45Ig58OxzOenXme2elgImLPCvN/yAJQip1mu/cjuzPUd2sQydFujGz4Uh3886z+5gAxg6tDRLn55DhM3gQW2NdhB7R/rEyYthN2rduUPAyKYvsSP8/ajaI4DApDWYAcCoMu8OgwOt5RDg7n/uzgYik77BjGDTKe93BrFN32LHMGsXcm+PHm3Aw32vkDUeHpvkY8i1Yh9SdGgjDqb9mzwF1ux+UQZTQpQVurQZ/YILhXQhsagAVgJdombMEJG/WaaSMQ90EVkP+JjMwadC+DAn6/wqJl/zNdmiqIxbKVlqDKkDSl2d8KMYLFOlnlt0kaiLS6Vc0WYYTISX/4xpX/RbnUKuSX1YqSiQCRmZ+JIJRvHIhWFLKMyPZZi/rIkHnKIm6grIrRSQ5ZYFJFFt9aW5qpQmrKb3pSlVx3/OLLyF52G6QAAAAABJRU5ErkJggg==" width="22" height="22" data-v-008a65cb="" id="select_img_bus_{{$check_tmp}}"> <!---->
                    <img alt="checkbox" class="div-hide" id="select_img_2_bus_{{$check_tmp}}" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAFqADAAQAAAABAAAAFgAAAAAcITNaAAACSUlEQVQ4EbWVP2gUQRTGvzc7MedtzGljYWIhQoQYLTQSFQKKtSYgNkZFxE4sLERJQGOnpLCzUBQRsbGIsRJsbBW7gIUERZIcIv65i3fH5XK7z3kjs+xddol3kmlm5s17v5n3duZbQkornN6zhauVESKMgLmfibaJKzHnQfSBGTOUyc5sfjb7KwlBzUY+fyRTXFq4whReAyPXvN4wJxSJ1Z1cd+9devymGl9rAFdO9fXUwuAFMw/GndYaE9H7DcobzT7/uOh8I7BAl8PgrUm7xy221BMtdipvyMGVBEv6ctK2oRbCf7M1LJlasK1pi+lLcHOTEgpL7GS//nL585ofqpmSNpcP2unvUHKl2oF6u/Yhe3nK5Ow1bmFukjC13FNzJ1tqXv8BdI0/RPg9nxgnTCWXP3E1xah3D6Fr4pGFlm6OAWGw2tMwlXtR8VU9eAwdwyfiJjvWA4fgT5iTfptH6cYYuPhjlY8YhKmTVvTAQWSOX0DF70bt1VProvcehn/9AcKvX1CaPANe+pkUGtm0vH1T4r7IYgbVJ7ehtvZi48VJIKibEy4Y6H2E+U8Gehb8O1EeIoQwqXBy57S5f6OR1Q10B/yr96D3HwXqNQTzcyjfOgcuFZxHak+gaSUqlehRX0F56hJW3r1GMDeLsqT/D1BhmQq8XL8HInoq0pd46jaMwhKm1Qqrp0b62uA0hIh8CkuM6yubsoPoqOip7CrzVprExLVYYm0pHETguU3bhwlq3ORSdPbUXpTM+EqME3jnG5XCGVz/vz/TPwESC7rVdcaIAAAAAElFTkSuQmCC" width="22" height="22" data-v-008a65cb="">
                    <div data-v-008a65cb id="select_text_bus_{{$check_tmp}}">
                        Chọn
                    </div>
                </div>
            </div>
        </div>
        <div class="route-option div-hide" data-v-008a65cb id="select_route_2_{{$check_tmp}}">
            <div class="form-group mb-0 row">
                <form action="{{route('applicant.book_ticket')}}" method="get">
                    <input type="hidden" name="step" value="3">
                    <input type="hidden" name="city_start" value="{{$request->city_start}}">
                    <input type="hidden" name="city_end" value="{{$request->city_end}}">
                    <div class="col-md-10" style="width:100%;">
                        <div class="input-group">
                            <label class="col-form-label col-md-2">Giờ Xuất Phát : </label>
                            <select name="departure_time" class="form-control">
                                @foreach($each_bus->departure_time as $key=>$value)
                                    <option value="{{$each_bus->departure_time[$key]}}">{{date("H:i", strtotime($each_bus->departure_time[$key]))}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="input-group">
                            <label class="col-form-label col-md-2">Địa điểm đón : </label>
                            <select name="address" class="form-control">
                                @foreach($arr_location as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Tiếp Theo</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <br>
    <?php $check_tmp++ ?>
    @endforeach
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-block" style="display: block;width: 100%;">Quay Lại</a>
    </div>
    <br>
    @endif
    @if($request->step == 2 && empty($arr_bus))
        <section class="ftco-section" style="padding:0px !important;text-align:center">
            <div class="route-option" data-v-008a65cb="">
                <div class="header" data-v-008a65cb="">
                    <p>Không Có Chuyến Đi Nào Vào Thời Gian Bạn Chọn</p>
                </div>
            </div>
        </section>
        <br>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-primary btn-block" style="display: block;width: 100%;">Quay Lại</a>
        </div>
    @endif
{{--    step 3 --}}
    @if($request->step == 3 && empty($arr_bus))
        <form data-v-46398b4b="" id="form-steps" method="post" action="{{route('applicant.info_customer')}}">
            <input type="hidden" name="city_start" value="{{$request->city_start}}">
            <input type="hidden" name="city_end" value="{{$request->city_end}}">
            <input type="hidden" name="departure_time" value="{{$request->departure_time}}">
            <input type="hidden" name="address_location" value="{{$request->address}}">
        <section class="ftco-section" style="padding:0px !important;text-align:center">
            <br>
            <div class="child" data-v-45436248="">
                <div data-v-b57fbcc0="" data-v-45436248="">
                    <div data-v-b57fbcc0="" class="row">
                        <div data-v-b57fbcc0="" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div data-v-46398b4b="" data-v-b57fbcc0="" class="info-container">
                                <p data-v-46398b4b="" class="title">THÔNG TIN HÀNH KHÁCH</p>
                                    <fieldset data-v-46398b4b="" style="width: 100%; padding-left: 16px; padding-right: 16px;">
                                        @csrf
                                        <p data-v-46398b4b="" class="input-title">
                                            Họ tên hành khách *
                                        </p> <input data-v-46398b4b="" placeholder="Họ và tên" id="name" name="name" required="required"
                                                    class="input full">
                                        <p data-v-46398b4b="" class="input-title">
                                            Số điện thoại *
                                        </p> <input data-v-46398b4b="" placeholder="Nhập số điện thoại" type="tel" id="phone" name="phone"
                                                    required="required" class="input half left">
                                        <p data-v-46398b4b="" class="input-title">
                                            Email *
                                        </p><input data-v-46398b4b="" placeholder="Nhập email" type="email" id="email" name="email"
                                                    required="required" class="input full">
                                        <p data-v-46398b4b="" class="input-title">
                                            Giới Tính *
                                        </p>
                                        <div style="text-align:left;font-size:20px;">
                                            <label for="gender_male" style="margin-right:10px;">Nam </label>
                                            <input placeholder="Nhập email" type="radio" id="gender_male" name="gender"
                                                   required="required" class="input full" checked value="1">
                                            <label for="gender_female" style="margin-right:10px;">Nữ </label>
                                            <input placeholder="Nhập email" type="radio" id="gender_female" name="gender"
                                                                                        required="required" class="input full" value="0">
                                        </div>
                                        <p data-v-46398b4b="" class="input-title">
                                            Ngày Sinh *
                                        </p><input data-v-46398b4b="" placeholder="" type="date" id="date" onfocus="this.showPicker()" name="birthdate"
                                                    required="required" class="input full">
                                        <p data-v-46398b4b="" class="input-title">
                                            Địa Chỉ*
                                        </p><input data-v-46398b4b="" placeholder="Nhập Địa Chỉ" type="address" id="address" name="address"
                                                    required="required" class="input full">
                                        <div data-v-46398b4b="" class="two-cols select-location">
                                            <div data-v-46398b4b="" style="width: 50%; padding-right: 16px;">
                                                <p data-v-46398b4b="" class="input-title">
                                                    Tỉnh/TP *
                                                </p>
                                                <select data-v-46398b4b="" class="form-control selectpick er half left select-city" id="select-city" name="city">
{{--                                                    <option data-v-46398b4b="" value="[object Object]">--}}
{{--                                                        Đắk Lắk--}}
{{--                                                    </option>--}}
                                                </select>
                                            </div>
                                            <div data-v-46398b4b="" style="width: 50%;">
                                                <p data-v-46398b4b="" class="input-title">
                                                    Quận/Huyện *
                                                </p>
                                                <select data-v-46398b4b="" class="form-control selectpicker half right select-district" id="select-district" name="district">
{{--                                                    <option data-v-46398b4b="" value="[object Object]">--}}
{{--                                                        Nhà Bè--}}
{{--                                                    </option>--}}
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                <div data-v-46797034="" data-v-46398b4b="" class="terms-and-policies" id="id-terms-and-policies">
                                    <input data-v-46797034="" type="checkbox" id="terms-policies-checkbox" class="terms-policies-checkbox" name="terms-policies-checkbox">
                                    <label data-v-46797034="" for="terms-policies-checkbox" class="terms-label">
                  <span data-v-46797034=""class="term-text" id="id-term-text">
                    Chấp nhận
                    <span data-v-46797034="" href="" class="link">điều khoản đặt vé</span>
                    của Thu Đức BusLines
                  </span></label></div>
                            </div>
                        </div>
                        <div data-v-b57fbcc0="" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div data-v-468abc57="" data-v-b57fbcc0="" class="notes-container">
                                <p data-v-468abc57="" class="title">ĐIỀU KHOẢN &amp; LƯU Ý</p>
                                <p data-v-468abc57="" class="txt">
                                    (*) Quý khách vui lòng mang email có chứa mã vé đến văn phòng để đổi vé lên xe trước giờ xuất bến ít
                                    nhất
                                    <span data-v-468abc57="" class="high-light">60 phút</span>
                                    để chúng tôi trung chuyển.
                                </p>
                                <p data-v-468abc57="" class="txt">(*) Thông tin hành khách phải chính xác, nếu không sẽ không thể lên xe
                                    hoặc hủy/đổi vé.</p>
                                <p data-v-468abc57="" class="txt">
                                    (*) Quý khách không được đổi/trả vé vào các ngày Lễ Tết (ngày thường quý khách được quyền chuyển đổi
                                    hoặc hủy vé
                                    <span data-v-468abc57="" class="high-light">một lần</span>
                                    duy nhất trước giờ xe chạy 24 giờ), phí hủy vé 10%.
                                </p>
                                <p data-v-468abc57="" class="txt">
                                    (*) Nếu quý khách có nhu cầu trung chuyển, vui lòng liên hệ số điện thoại
                                    <a data-v-468abc57="" href="tel:1900 6067" class="high-light">1900 6067</a>
                                    trước khi đặt vé. Chúng tôi không đón/trung chuyển tại những điểm xe trung chuyển không thể tới được.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="booking-nav-buttons" data-v-3f93c73c="" data-v-45436248="">
                <div class="left-btns" data-v-3f93c73c="">
                    <a href="{{ url()->previous() }}" class="btn btn-primary btn-block" style="display: block;width: 100%;">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABICAYAAABV7bNHAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAASKADAAQAAAABAAAASAAAAACQMUbvAAACSklEQVR4Ae3aT07CQBQGcKrAyh22cAiDngGix/BwHMOoW9eohygV1iRAqO/FEppaoJH58435utDpFN7M/CxD5zmtFg8KUIACFKAABShAAQpQgAIUoAAFKPCvBKKQRjMYDOLVavWofe52u5M0Tb9s9z8YoCRJbjebzVOe54miRFGUCtLQNtKl7b+AifiKs16vXyRWXIp3td1uZ8vl8q1UZ7x4YTyi4YAlnJ7h0I3CQQMdw5GPWKbzUKNRnvEiWKBjODLeebvdvrc9/6gr5CR9CqfT6YyzLHs/48Zo/FY4ICQcuDsIDQcKCBEHBggVBwIIGcc7EDqOV6AQcLwBhYKjQM4Xq3Ec38mqXBeedWurucuHQAU4dTh9UCxwnqVTQeAonjOgEHGcAYWK4wSo3+8nkib9lMbKyS5tWw+4OeenW/uf7X3RTkkygZpDrsWR+pGsyj/stGwmqot8UH6gq5F8Y7lo/0Dzzaqtd1CzfpL9m9V0p6d5Zn0mqrkGU2UdSLN+kv17kBHPa0YNj+Tsa17ulGHxn4nrGqhF8YA4rbnmtcoZkI4yRCSnQCEiOQcKDckLUEhI3oBCQfIKFAKSdyB0JAggZCQYIFQkKCBEJDggNCRIoBLSq5Tr8tfO1m6wQKeQig1UN7b3CFlPd+hA/3roHiBZ5Y/k/YtqDN3MudvxWr1m8hwaSAdaII2l+AvJJMShWPBA2nFBmmq+SD9Wu4FIWbcBT3bntn5Dz0HVQfvYSF7tA88pQAEKUIACFKAABShAAQpQgAIUoEDgAt/KjWWzclDJlgAAAABJRU5ErkJggg==" alt="back" width="24" height="24" class="icon" data-v-3f93c73c="">
                        Quay lại
                    </a>
                </div>
                <div data-v-3f93c73c="" class="right-btns">
                    <button data-v-3f93c73c="" class="next-btn" type="submit">
                        Tiếp tục
                        <img data-v-3f93c73c="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABICAYAAABV7bNHAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAASKADAAQAAAABAAAASAAAAACQMUbvAAABnklEQVR4Ae3a4W3CMBCGYdIVUBkDmKGDdIkyUffoEizRUtoZ0u8QkSrrcjE0DTh+LUWQu2AnTy4/cLxY0BBAAAEEEEAAAQQQQAABBBBAAIFZCTRTXE3bto8a5/k81mvTNMcpxi1iDMPR9q6tawd92RRx8lOcpDBeOplfn1+lID1MgeSMsVTsrRQk5/zHCwnBHjF7rLxWTCWNJ+L0JJm1NsPwGkhmJhlDOnpCioEEkvNoeSEqyVNJYiAlIN4uSJ5KEgMpAfF2QfJUkhhICYi3C5KnksQykLbJT+rbBSnjnoMEUoZAxiEDlfSp/Cqjm3kfMoC0+++rv9WM4iXXZS8W+l4utJd0NLtjVT0bbX0TbR/K2duSOtsAjk28reuU0VWDE9x6cMAJBIIUlQNOIBCkqBxwAoEgReWAEwgEKSoHnEAgSFE51+PYv/Wq/3gOLaCqF8eKStXhrVFU+DTPc/c4t5pR/Jbdk5YD74Mns46UKsVbBnz3ldPdnb653i4/yqchqSMWko+iSScIIIAAAggggAACCCCAAAIIIIDAnwR+AARz1rJJfntoAAAAAElFTkSuQmCC" alt="back" width="24" height="24" class="icon">
                    </button>
                </div>
            </div>
        </section>
        </form>
        <br>
    @endif
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script>
            function select_checkbox(key){
                let id_text = 'select_text_bus_'+key;
                let id_img = 'select_img_bus_'+key;
                let id_img_2 = 'select_img_2_bus_'+key;
                let id_route = 'select_route_'+key;
                let id_route_2 = 'select_route_2_'+key;
                let select_text_bus = document.getElementById(id_text);
                let select_img = document.getElementById(id_img);
                let select_img_2 = document.getElementById(id_img_2);
                let select_route = document.getElementById(id_route);
                let select_route_2 = document.getElementById(id_route_2);
                select_text_bus.classList.toggle("selected");
                select_img.classList.toggle("div-hide");
                select_img_2.classList.toggle("div-block");
                select_route.classList.toggle("selected");
                select_route_2.classList.toggle("selected");
                select_route_2.classList.toggle("div-block");
            }
            function book_ticket(city_start_id, city_end_id){
                let city_start = document.getElementById('city_start');
                let city_end = document.getElementById('city_end');
                city_start.value = city_start_id;
                city_end.value = city_end_id;
            }

            async function loadDistrict(parent) {
                parent.find(".select-district").empty();
                const path = parent.find(".select-city option:selected").data('path');
                if (!path) {
                    return;
                }
                const response = await fetch('{{ asset('locations/') }}' + path);
                const districts = await response.json();
                let string = '';
                const selectedValue = $("#select-district").val();
                $.each(districts.district, function (index, each) {
                    if (each.pre === 'Quận' || each.pre === 'Huyện') {
                        string += `<option data-v-46398b4b=""`;
                        if (selectedValue === each.name) {
                            string += ` selected `;
                        }
                        string += `>${each.name}</option>`;
                    }
                })
                parent.find(".select-district").append(string);

            }
            $(document).ready(async function () {
                $("#select-city").select2({tags: true});
                const response = await fetch('{{ asset('locations/index.json') }}');
                const cities = await response.json();
                $.each(cities, function (index, each) {
                    $("#select-city").append(`
                <option data-v-46398b4b="" data-path='${each.file_path}'>
                    ${index}
                </option>`)
                })
                $("#select-city").change(function () {
                    loadDistrict($(this).parents('.select-location'));
                });
                $('#select-district').select2({tags: true});
                await loadDistrict($('#select-city').parents('.select-location'));


                //validation
                jQuery.validator.addMethod('valid_name', function (value) {
                    var regex = /^[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+ [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+(?: [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*)*$/;
                    return value.trim().match(regex);
                });
                jQuery.validator.addMethod('valid_phone', function (value) {
                    var regex = /^[\+|0]\d{1,13}$/;
                    return value.trim().match(regex);
                });
                $("#form-steps").validate({
                    rules: {
                        name: {
                            required: true,
                            valid_name: true
                        },
                        phone: {
                            required: true,
                            digits: true,
                            valid_phone:true,
                        },
                        email: {
                            required:true,
                            email: true,
                        },
                        birthdate: {
                            required: true,
                            date: true,
                        },
                        address:{
                            required:true,
                        },
                    },
                    messages:{
                        name: {
                            required: "Tên không được bỏ trống",
                            valid_name: "Tên không hợp lệ"
                        },
                        phone: {
                            required: "Số điện thoại không được bỏ trống",
                            digits: "Số nhập vào phải là số tự nhiên",
                            valid_phone:"Số điện thoại phải thuộc nhà mạng của Việt Nam"
                        },
                        email: {
                            required:"Email không được bỏ trống",
                            email: "Địa chỉ email không hợp lệ",
                        },
                        birthdate: {
                            required: "Ngày sinh không được bỏ trống",
                            date: "Dữ liệu nhập vào phải là ngày",
                        },
                        address:{
                            required:"Không được bỏ trống",
                        }
                    },
                    submitHandler: function (form) {
                        if (document.getElementById('terms-policies-checkbox').checked) {
                            form.submit();
                        } else {
                            alert("Bạn chưa chấp nhận điều khoản đặt vé của chúng tôi !");
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
