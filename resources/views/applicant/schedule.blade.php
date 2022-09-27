@extends('layout.master')
@push('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/jquery.toast.min.css')}}">
    <link rel="stylesheet" href="https://futabus.vn/_nuxt/css/7c328b7.css">
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #33313B !important;
            border: 0px !important;
            margin-left: 18px !important;
        }
    </style>
@endpush
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
             style="background-image:url(images/xbg_1.jpg.pagespeed.ic.CxKtYSNFRY.jpg)" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb-3 bread">Lịch Trình</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section" style="padding: 3em 0em 0em 0em !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Các tuyến xe của nhà xe Thu Đức</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pb ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="search-wrap-1 search-wrap-notop ftco-animate p-4">
                        <form action="#" class="search-property-1">
                            <div class="row">
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Điểm Đi</label>
                                        <div class="form-field">
                                            <div class="icon"><span class="ion-ios-search"></span></div>
                                            <select type="text" class="form-control" placeholder="Chọn nơi đi" id="select-city-start-id"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Điểm Đến</label>
                                        <div class="form-field">
                                            <div class="icon"><span class="ion-ios-search"></span></div>
                                            <select type="text" class="form-control" placeholder="Chọn nơi đến" id="select-city-end-id"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg align-self-end">
                                    <div class="form-group">
                                        <div class="form-field">
                                            <input type="submit" value="Search" class="form-control btn btn-primary">
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
    <section class="ftco-section ftco-no-pb ftco-no-pt">
        <div class="container">
            <div class="row">

                <div class="table-responsive">
                    <!-- thiếu class datatable-->
                    <table class="table table-hover table-center mb-0" id="table-index" style="text-align: center">
                        <thead>
                        <tr>
                            <th>Điểm Đi</th>
                            <th>Điểm Về</th>
                            <th>Tuyến Xe</th>
                            <th>Loại Xe</th>
                            <th>Loại Ghế</th>
                            <th>Thời Gian</th>
                            <th>Khoảng Cách</th>
                            <th>Giá Vé Giờ Chạy - Thông tin chi tiết</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="booking-nav-buttons" data-v-3f93c73c="" data-v-45436248="">
                <div class="left-btns" data-v-3f93c73c=""><button class="back-btn" data-v-3f93c73c=""><img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABICAYAAABV7bNHAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAASKADAAQAAAABAAAASAAAAACQMUbvAAACSklEQVR4Ae3aT07CQBQGcKrAyh22cAiDngGix/BwHMOoW9eohygV1iRAqO/FEppaoJH58435utDpFN7M/CxD5zmtFg8KUIACFKAABShAAQpQgAIUoAAFKPCvBKKQRjMYDOLVavWofe52u5M0Tb9s9z8YoCRJbjebzVOe54miRFGUCtLQNtKl7b+AifiKs16vXyRWXIp3td1uZ8vl8q1UZ7x4YTyi4YAlnJ7h0I3CQQMdw5GPWKbzUKNRnvEiWKBjODLeebvdvrc9/6gr5CR9CqfT6YyzLHs/48Zo/FY4ICQcuDsIDQcKCBEHBggVBwIIGcc7EDqOV6AQcLwBhYKjQM4Xq3Ec38mqXBeedWurucuHQAU4dTh9UCxwnqVTQeAonjOgEHGcAYWK4wSo3+8nkib9lMbKyS5tWw+4OeenW/uf7X3RTkkygZpDrsWR+pGsyj/stGwmqot8UH6gq5F8Y7lo/0Dzzaqtd1CzfpL9m9V0p6d5Zn0mqrkGU2UdSLN+kv17kBHPa0YNj+Tsa17ulGHxn4nrGqhF8YA4rbnmtcoZkI4yRCSnQCEiOQcKDckLUEhI3oBCQfIKFAKSdyB0JAggZCQYIFQkKCBEJDggNCRIoBLSq5Tr8tfO1m6wQKeQig1UN7b3CFlPd+hA/3roHiBZ5Y/k/YtqDN3MudvxWr1m8hwaSAdaII2l+AvJJMShWPBA2nFBmmq+SD9Wu4FIWbcBT3bntn5Dz0HVQfvYSF7tA88pQAEKUIACFKAABShAAQpQgAIUoEDgAt/KjWWzclDJlgAAAABJRU5ErkJggg=="
                            alt="back" width="24" height="24" class="icon" data-v-3f93c73c="">
                        Quay lại
                    </button>
                    <!---->
                </div>
                <div data-v-3f93c73c="" class="right-btns"><button data-v-3f93c73c="" class="next-btn">
                        Tiếp tục
                        <img data-v-3f93c73c=""
                             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABICAYAAABV7bNHAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAASKADAAQAAAABAAAASAAAAACQMUbvAAABnklEQVR4Ae3a4W3CMBCGYdIVUBkDmKGDdIkyUffoEizRUtoZ0u8QkSrrcjE0DTh+LUWQu2AnTy4/cLxY0BBAAAEEEEAAAQQQQAABBBBAAIFZCTRTXE3bto8a5/k81mvTNMcpxi1iDMPR9q6tawd92RRx8lOcpDBeOplfn1+lID1MgeSMsVTsrRQk5/zHCwnBHjF7rLxWTCWNJ+L0JJm1NsPwGkhmJhlDOnpCioEEkvNoeSEqyVNJYiAlIN4uSJ5KEgMpAfF2QfJUkhhICYi3C5KnksQykLbJT+rbBSnjnoMEUoZAxiEDlfSp/Cqjm3kfMoC0+++rv9WM4iXXZS8W+l4utJd0NLtjVT0bbX0TbR/K2duSOtsAjk28reuU0VWDE9x6cMAJBIIUlQNOIBCkqBxwAoEgReWAEwgEKSoHnEAgSFE51+PYv/Wq/3gOLaCqF8eKStXhrVFU+DTPc/c4t5pR/Jbdk5YD74Mns46UKsVbBnz3ldPdnb653i4/yqchqSMWko+iSScIIIAAAggggAACCCCAAAIIIIDAnwR+AARz1rJJfntoAAAAAElFTkSuQmCC"
                             alt="back" width="24" height="24" class="icon"></button>
                    <!---->
                    <!---->
                </div>
            </div>
        </div>
    </section>
@push('js')
    <script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.toast.min.js')}}"></script>
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
        $("#select-city-start-id").select2({
            ajax: {
                url: "{{route('api.routes.city_end')}}",
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;

                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.name
                            }
                        })
                    };
                }
            },
            placeholder: 'Nhập tên tỉnh đi',
            allowClear:true
        });
        $("#select-city-end-id").select2({
            ajax: {
                url: "{{route('api.routes.city_end')}}",
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;

                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.name
                            }
                        })
                    };
                }
            },
            placeholder: 'Nhập tên tỉnh đi',
            allowClear:true
        });

        let table = $('#table-index').DataTable({
            destroy: true,
            dom: 'ltrp',
            lengthMenu:[10,15,25,50,100],
            select: true,
            processing: true,
            serverSide: true,
            searchable:false,
            ajax: '{!! route('api.schedule') !!}',
            columns: [
                {data: 'city_start', name: 'city_start'},
                {data: 'city_end', name: 'city_end'},
                {data: 'name', name: 'name'},
                {data: 'category_car', name: 'category_car'},
                {data: 'seat_type_car', name: 'seat_type_car'},
                {data: 'time', name: 'time'},
                {data: 'distance', name: 'distance'},
                {
                    data: 'show',
                    targets: 7,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return `<a class="btn btn-primary"
                        href="{{route('applicant.book_ticket_2')}}?city_start=${data.city_start_id}&city_end=${data.city_end_id}&departure_time=${data.date_today}">
                        ĐẶT VÉ
                        </a>`;
                    }
                },
            ],
        });

        $('#select-city-start-id').change(function () {
            table.columns(0).search(this.value).draw();
        });

        $('#select-city-end-id').change(function () {
            table.columns(1).search(this.value).draw();
        });

    </script>
@endpush
@endsection
