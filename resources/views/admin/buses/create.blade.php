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
                    <h4 class="card-title">Thêm Chuyến Xe</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.buses.store')}}" id="form" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Tuyến đường</label>
                            <div class="col-md-10">
                                <select class="form-control" name="route" id="route">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Xe</label>
                            <div class="col-md-10">
                                <select class="form-control" name="car" id="license-plate">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Tài xế</label>
                            <div class="col-md-10">
                                <input class="form-control" name="driver" id="driver" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Ngày khởi hành</label>
                            <div class="col-md-10">
                                <input class="form-control" name="date" id="date" type="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Giờ đi</label>
                            <div class="col-md-10">
                                <input class="form-control" name="time" id="time" type="time">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Giá chuyến đi</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="price" id="price" placeholder="Giá">
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <button class="btn btn-primary" type="submit">Thêm Chuyến Xe</button>
                            <a href="{{route('admin.buses.index')}}" class="btn btn-link">Quay Lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script>
            $(document).ready(function() {
                $('#route').select2({
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
                        }
                    },
                    placeholder: 'Chọn tuyến đường',
                    allowClear:true
                });

                $('#route').change(function() {
                    let route_id = $(this).val();
                    $('#license-plate').select2({
                        ajax: {
                            url: "{{route('admin.carriages.api.nameCarriages')}}",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term, // search term
                                    route_id: route_id,
                                };
                            },
                            processResults: function (data, params) {
                                params.page = params.page || 1;

                                return {
                                    results: $.map(data, function (item) {
                                        return {
                                            text: item.license_plate,
                                            id: item.id,
                                        }
                                    })
                                };
                            }
                        },
                        placeholder: 'Chọn bảng số xe',
                        allowClear:true,
                    });
                });

                $('#license-plate').change(function() {
                    var car_id = $(this).val();
                    var route_id = $('#route').val();
                    $.ajax({
                        url: "{{route('admin.users.apiGetDriverByCar')}}",
                        type: "GET",
                        delay: 250,
                        data: {
                            car_id: car_id,
                            route_id: route_id,
                        },
                        success: function(response) {
                            $('#driver').val(response.name);
                        },
                    });
                    $.ajax({
                        url: "{{route('admin.buses.api.apiGetPrice')}}",
                        type: 'GET',
                        delay: 250,
                        data: {
                            car_id: car_id,
                            route_id: route_id,
                        },
                        success: function(response) {
                            $('#price').val(response.price);
                        },
                    });
                });
                //validation
                $("#form").validate({
                    rules: {
                        route: {
                            required: true,
                        },
                        car: {
                            required: true,
                        },
                        date: {
                            required: true,
                        },
                        time: {
                            required: true,
                        },
                        price: {
                            required: true,
                        },
                    },
                    messages:{
                        route: {
                            required: 'Vui lòng chọn tuyến đường',
                        },
                        car: {
                            required: 'Vui lòng chọn xe',
                        },
                        date: {
                            required: 'Vui lòng chọn ngày khởi hành',
                        },
                        time: {
                            required: 'Vui lòng chọn giờ đi',
                        },
                        price: {
                            required: 'Vui lòng nhập giá',
                        },
                    },
                    submitHandler: function(form) {
                        $.ajax({
                            url: form.action,
                            type: form.method,
                            data: $(form).serialize(),
                            success: function(response) {
                                notify(response);
                                if(response.success){
                                    setTimeout(function(){
                                        window.location.href = "{{route('admin.buses.index')}}";
                                    }, 3000);
                                };
                            },
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
