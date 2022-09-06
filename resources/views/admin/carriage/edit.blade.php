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
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thông tin xe</h4>
                </div>
                    <div class="card-body">
                        <form action="{{route('admin.carriages.update',$carriage)}}" id="form" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Biển số xe</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="license_plate" value="{{$carriage->license_plate}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" for="select-category">Loại xe</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="category">
                                        @foreach($categories as $category=>$value)
                                            <option value="{{$value}}"
                                                @if ($carriage->category == $value)
                                                    selected
                                                @endif
                                            >{{$category}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" for="select-seat-type">Loại ghế ngồi</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="seat_type">
                                        @foreach($seatTypes as $seatType=>$value)
                                            <option value="{{$value}}"
                                            @if ($carriage->seat_type == $value)
                                                selected
                                            @endif
                                            >{{$seatType}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2" for="seat-number">Số lượng ghế</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="default_number_seat" value="{{$carriage->default_number_seat}}">
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button class="btn btn-primary" type="submit">Sửa Thông Tin</button>
                                <a href="{{route('admin.carriages.index')}}" class="btn btn-link">Quay Lại</a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tuyến đường liên kết</h4>
                </div>
                    <div class="card-body">
                        <form action="{{route('admin.carriages.updateRDC',$carriage)}}" id="form-route" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="col-form-label">Tuyến đường</label>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="col-form-label">Tuyến đi</label>
                                    <select class="select col-md-12" id="route_from" name="route_from"></select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="col-form-label">Tuyến về</label>
                                    <select class="select col-md-12" id="route_to" name="route_to"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" for="select-seat-type">Tài xế</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="driver" id="driver">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Giá theo tuyến đường</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="price" id="price" placeholder="Giá">
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button class="btn btn-primary" type="submit">Sửa Thông Tin</button>
                                <a href="{{route('admin.carriages.index')}}" class="btn btn-link">Quay Lại</a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script>
            function submitForm(form){
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        notify(response);
                    },
                    error: function(response) {
                        // get key and value in response object
                        var errors = response.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $.toast({
                                heading: 'Lỗi',
                                text: value,
                                icon: 'error',
                                position: 'top-right',
                                showHideTransition: 'slide',
                            });
                        });
                    }
                });
            }

            $(document).ready(async function() {
                //validation
                jQuery.validator.addMethod('valid_license_plate', function (value) {
                    var regex = /^[0-9]{1,2}-[A-Z0-9]{1,2}-[0-9]{4,5}$/;
                    return value.trim().match(regex);
                });

                $('#price').val({{$RDC->price}});
                
                $("#form").validate({
                    rules: {
                        license_plate: {
                            required: true,
                            valid_license_plate: true,
                        },
                        category: {
                            required: true,
                        },
                        seat_type: {
                            required: true,
                        },
                        default_number_seat: {
                            required: true,
                            number: true,
                            min: 10,
                            max: 100,
                        },
                    },
                    messages: {
                        license_plate: {
                            required: "Vui lòng nhập biển số xe",
                            valid_license_plate: "Biển số xe không hợp lệ",
                        },
                        category: {
                            required: "Vui lòng chọn loại xe",
                        },
                        seat_type: {
                            required: "Vui lòng chọn loại ghế ngồi",
                        },
                        default_number_seat: {
                            required: "Vui lòng nhập số lượng ghế",
                            number: "Vui lòng nhập số",
                            min: "Số lượng ghế phải lớn hơn 10",
                            max: "Số lượng ghế phải nhỏ hơn 100",
                        },    
                    },
                    submitHandler: function (form) {
                        submitForm(form);
                    }
                });

                $("#form-route").validate({
                    rules: {
                        route_from: {
                            required: true,
                        },
                        route_to: {
                            required: true,
                        },
                        driver: {
                            required: true,
                        },
                        price: {
                            required: true,
                            number: true,
                            min: 0,
                        },
                    },
                    messages: {                       
                        route_from: {
                            required: "Vui lòng chọn địa điểm đi",
                        },
                        route_to: {
                            required: "Vui lòng chọn địa điểm đến",
                        },
                        driver: {
                            required: "Vui lòng chọn tài xế",
                        },
                        price: {
                            required: "Vui lòng nhập giá",
                            number: "Vui lòng nhập số",
                            min: "Giá phải lớn hơn 0",
                        },
                    },
                    submitHandler: function (form) {
                        submitForm(form);
                    }
                });

                $('#route_from').select2({
                    ajax: {
                        url: "{{route('admin.routes.api.name_routes')}}",
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
                                        id: item.id,
                                    }
                                })
                            };
                        },
                    },
                    placeholder: 'Chọn tuyến đường',
                });
                $('#route_from').select2('trigger', 'select', {
                    data: {
                        text: '{{$route->name}}',
                        id: {{$route->id}}
                    }
                });

                $('#route_to').select2({
                    ajax: {
                        url: "{{route('admin.routes.api.name_routes')}}",
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
                                        id: item.id,
                                    }
                                })
                            };
                        },
                    },
                    placeholder: 'Chọn tuyến đường',
                });
                $('#route_to').select2('trigger', 'select', {
                    data: {
                        text: '{{$routeReverse->name}}',
                        id: {{$routeReverse->id}}
                    }
                });

                // route_from change
                $('#route_from').on('change', function() {
                    let route_from = $('#route_from').val();
                    route_id = $('#route_from').val();
                    $.ajax({
                        url: '{{ route('admin.routes.apiGetRouteInverse') }}',
                        type: 'GET',
                        data: {
                            route: route_from
                        },
                        success: function(res) {
                            $('#route_to').empty();
                            $('#route_to').select2({
                                placeholder: 'Chọn tuyến đường',
                                tags: true,
                                data: [{
                                    id: res.id,
                                    text: res.name
                                }]
                            });
                        }
                    });
                });

                $('#route_to').on('change', function() {
                    let route_to = $('#route_to').val();
                    route_id = $('#route_from').val();
                    $.ajax({
                        url: '{{ route('admin.routes.apiGetRouteInverse') }}',
                        type: 'GET',
                        data: {
                            route: route_to
                        },
                        success: function(res) {
                            $('#route_from').empty();
                            $('#route_from').select2({
                                placeholder: 'Chọn tuyến đường',
                                tags: true,
                                data: [{
                                    id: res.id,
                                    text: res.name
                                }]
                            });
                        }
                    });
                });

                $('#driver').select2({
                    ajax: {
                        url: "{{route('admin.users.api.name_drivers')}}",
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
                                        id: item.id,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Nhập tên tài xế',
                    allowClear:true
                });
                $('#driver').select2('trigger', 'select', {
                    data: {
                        text: '{{$driver->name}}',
                        id: {{$driver->id}}
                    }
                });
            });
        </script>
    @endpush
@endsection
