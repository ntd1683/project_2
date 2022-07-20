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
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    @if($request->step == 1|| !isset($request->step))
                    <h2 class="mb-4">Lộ Trình Phổ Biến</h2>
                     @endif
                    @if($request->step == 2)
                    <h2 class="mb-4">Xác Nhận Lộ Trình</h2>

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
