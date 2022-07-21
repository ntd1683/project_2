@extends('layout.master')
@push('css')
    <style>
        @charset "UTF-8";
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

        @media screen and (max-width:767px) {

            .route-option .label>.dot[data-v-008a65cb] {
                margin: 3px;
            }
        }

    </style>
@endpush
@section('content')
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
    @foreach($arr_bus as $each_bus)
    <section class="ftco-section" style="padding:0px !important;text-align:center">
        <div class="route-option" data-v-008a65cb="">
            <div class="header" data-v-008a65cb="">
                <p>
                    {{date("h:m", strtotime($each_bus->departure_time['0']))}}</p>
{{--                <img alt="fromto" width="28" height="7" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADgAAAAOCAYAAAB6pd+uAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAOKADAAQAAAABAAAADgAAAAAjNiV1AAABjklEQVRIDWNgGGQgraTRO7OiXZBazmKilkHUMuffPwaFX39+ZaSXN+lTw8xB50FGRgYmxn8MbH9//w9ILmoMLezr46TEo4POg/8ZgV6EAiBD68uTL5nAJKsEEyOVZiZVA63VG1nYWzIwMHIg2cP+7+9ffWMrRw4/d4eHBw4c+IckR5A56GIQGGtY3fT/P4PFk0+MqSlVreIEfYWkAKthSPJ0ZyInUSyWizH+/JuaVNJk+f//f3hSxqIOLjToPMgALGTgrsPCAHqMmenff7fUsubY3IYGPixKUITwGoaikk4cYAlKnJv+/lf88YUxM7W8SRuf04gzDJ8JVJYjkERRbPv/j4Hj/+//IamFjYG5kyaxo0hCOYwpRY312CSGntj/j0ysHOtmdVY8Qnb7oItBZMeRxmbk//f7ZyKwceAcumoVvPobRh6EBAewaLXhP3kjOa24QQQkwmxk6egAkRqcJDBP/mcAImDpCkQgBgMom/4DYmBFAaorgMUSAwMEMzL+BSr5BxTkBNabeqZ2Tp8BQTlvqFxYe+QAAAAASUVORK5CYII=" data-v-008a65cb="">--}}
{{--                20:15--}}
                <div class="utilities" data-v-008a65cb="">
                    <img alt="water utilitie" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAhUExURUdwTKOstKKstKOss6OrtKOttKOstKautaOttaazuqKrs9iuYewAAAAKdFJOUwBTqMbYepIsaxVu35VTAAAAaUlEQVQoz2NgIBIICgpKIvMZV61atQJdYCmyAKexsbE5fkOFlJQCkPkcXqtWuSILaAENXWWAagmKNWxggcUIASawwBI8AhxggWUIAXawwEI8hrKCBRbRQssiUpxOtgCSwzgFQUCcyGgHAESfV/tGvoBwAAAAAElFTkSuQmCC" width="16" height="16" data-v-008a65cb="">
                    <img alt="tissue utilitie" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAbUExURUdwTKSttKOstqevuKKstKOstKOstKOstKKrs1QBF0QAAAAIdFJOUwBxUB7irc+RSBqH+QAAAHtJREFUKM9jYKAFUFJSRnCMlJQYOjraDGB85oyODqBAh6MgFIh1QARQAEMEKr+VgR1VIIDBA0QVKSkpqYMFWhgg6kBAAmKGCJBoBAuYgfiODKZwAQagKzqCwVqgAmA9mAIYWjAMxbAWw2EYTsfwHIb3sQQQWhBiBDItAABMgnXv5SJBWwAAAABJRU5ErkJggg==" width="16" height="16" data-v-008a65cb="">
                    <img alt="form utilitie" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAtUExURUdwTKvMzKWvt6Oss6eyuaSstqOttaKstKOstKOstKOstKWtt6OstKOstKKrs+TeAR8AAAAOdFJOUwAGI/ATRmDhx7miNot2T+ML3AAAANBJREFUKM9jYKAZYNx2as1VBwSfdfE7IHiRCONzz3sHBs8vQtWfA3Ie24HUKIAFPICs2wKMakB9ZiA+U927lxtADJbD794lAGn3d4+BlJAKUKrv3SOgQNy7agbGG+/eWQUwSL17ChRwfq7AkA6y5KUC4+EFIK0hDDwQa03hDlsHdEMz0OoNUD7bu3dvHRg0372bABXgffcc5KI8uABLXQvYR50KMDOEBBgyp6H6H2jMARQB9nfvHqIIyL0DuxoBON+9K0ARYKqDuwoKREMY6AkAd2hhK9YYGPUAAAAASUVORK5CYII=" width="16" height="16" data-v-008a65cb="">
                </div>
            </div>
            <div class="label" data-v-008a65cb="">
                {{$each_bus->price}} <span class="dot" data-v-008a65cb=""></span>
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
                <div class="action" data-v-008a65cb="">
                    <img alt="checkbox" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAAtFBMVEUAAAAAgICAgL+Upa2Pl5+bo6uVoKuWoKqfqLGWn6mapK2Zo62dpq+apa6dp7Cep6+ep7CbprCdp7Ccpa+cpq+bpq6ep7Gcpq+dp7Ccp7Cbpq+dprD////+///+/v76+vv6+vr4+fn29/f19vfx8vTs7vDr7e/i5efa3uHa3eDV2d3U2d3S1tvM0ta7wsixucCvt76psrqmrregqrKgqbKfqLKeqLGdp7CdprCcpq+bpa+bpa4Vzj1GAAAAHHRSTlMAAgQfID1GS1JoeX2Mp7m6v8zT4uPk7vP4+/v86VxdYgAAAX1JREFUeNqVldmSgjAQRaO44bjhrpNBZWBAQSBsmab//7/GoqgpXJDkPJ+HTtK5lzygdNXxfL3drudjtauQd/SnC8g45Ig58OxzOenXme2elgImLPCvN/yAJQip1mu/cjuzPUd2sQydFujGz4Uh3886z+5gAxg6tDRLn55DhM3gQW2NdhB7R/rEyYthN2rduUPAyKYvsSP8/ajaI4DApDWYAcCoMu8OgwOt5RDg7n/uzgYik77BjGDTKe93BrFN32LHMGsXcm+PHm3Aw32vkDUeHpvkY8i1Yh9SdGgjDqb9mzwF1ux+UQZTQpQVurQZ/YILhXQhsagAVgJdombMEJG/WaaSMQ90EVkP+JjMwadC+DAn6/wqJl/zNdmiqIxbKVlqDKkDSl2d8KMYLFOlnlt0kaiLS6Vc0WYYTISX/4xpX/RbnUKuSX1YqSiQCRmZ+JIJRvHIhWFLKMyPZZi/rIkHnKIm6grIrRSQ5ZYFJFFt9aW5qpQmrKb3pSlVx3/OLLyF52G6QAAAAABJRU5ErkJggg==" width="22" height="22" data-v-008a65cb=""> <!---->
                    <div data-v-008a65cb="">
                        Chọn
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    @push('js')
        <script>
            function book_ticket(city_start_id, city_end_id){
                let city_start = document.getElementById('city_start');
                let city_end = document.getElementById('city_end');
                city_start.value = city_start_id;
                city_end.value = city_end_id;
                console.log(city_start_id);
                console.log(city_end_id);
            }
            @if(!isset($request->departure_time))
            $(document).ready( function() {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = dd + '/' + mm + '/' + yyyy;
                $('#departure-day').val(today);
            });
            @endif
        </script>
    @endpush
@endsection
