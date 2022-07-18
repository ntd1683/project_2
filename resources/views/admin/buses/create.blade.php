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
                    <form action="{{route('admin.buses.store')}}" id="form-create-post" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label">Tên chuyến xe</label>
                                <select class="form-control" name="route" id="route" value="{{old('route')}}">
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label">Điểm đi</label>
                                <select class="form-control" name="from" id="from">
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label">Điểm đến</label>
                                <select class="form-control" name="to" id="to">
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
                                <select class="form-control" name="driver" id="driver">
                                </select>
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
                            <label class="col-form-label col-md-2">Giá</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="price" id="price" placeholder="Giá">
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <button class="btn btn-primary" type="submit" onclick="alert('Vui lòng chờ 5s !!! Cảm ơn')">Thêm Chuyến Xe</button>
                            <a href="{{route('admin.buses.index')}}" class="btn btn-link">Quay Lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
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
                    placeholder: 'Nhập tên chuyến đi',
                    allowClear:true
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
                
                $('#license-plate').select2({
                    ajax: {
                        url: "{{route('admin.carriages.api.name_carriages')}}",
                        dataType: 'json',
                        delay: 250,
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

                $('#from').select2({
                    ajax: {
                        url: "{{route('admin.cities.api.city')}}",
                        dataType: 'json',
                        delay: 250,
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
                    placeholder: 'Điểm đi',
                    allowClear:true,
                });

                $('#to').select2({
                    ajax: {
                        url: "{{route('admin.cities.api.city')}}",
                        dataType: 'json',
                        delay: 250,
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
                    placeholder: 'Điểm đến',
                    allowClear:true,
                });

                // parent change and child change
                $('#route').on('change', function() {
                    var route_id = $(this).val();
                    $.ajax({
                        url: "{{route('admin.routes.api.apiGetCityByRoute')}}",
                        type: 'GET',
                        data: {
                            route_id: route_id,
                        },
                        success: function(data) {
                            // 'from' select2 change url dataname = data.name;
                            console.log(data);
                            $('#from').select2({
                                ajax: {
                                    url: "{{route('admin.cities.api.city')}}",
                                    dataType: 'json',
                                    delay: 250,
                                    data: function (params) {
                                        return {
                                            q: params.term, // search term
                                            city_id: (data[0] != null) ? data[0].city_start_id : null,
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
                                placeholder: 'Điểm đi',
                                allowClear:true,
                            });

                            // 'to' select2 change url data
                            $('#to').select2({
                                ajax: {
                                    url: "{{route('admin.cities.api.city')}}",
                                    dataType: 'json',
                                    delay: 250,
                                    data: function (params) {
                                        return {
                                            q: params.term, // search term
                                            city_id: (data[0] != null) ? data[0].city_end_id : null,
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
                                placeholder: 'Điểm đến',
                                allowClear:true,
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
