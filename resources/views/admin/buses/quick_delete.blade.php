@extends('admin.layout.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
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

<form action="{{route('admin.buses.quickDestroy')}}" id="form" method="post">
@csrf
@method('DELETE')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Xóa nhanh</h4>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="form-group col-lg-6">
                        <label>Tuyến đi</label>
                        <div class="col-lg-12">
                            <select class="select col-md-12" id="route_from" name="route_from"></select>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Tuyến về</label>
                        <div class="col-lg-12">
                            <select class="select col-md-12" id="route_to" name="route_to"></select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label>Năm</label>
                    <div class="form-group">
                        <select class="select col-md-12" id="year" name="year"></select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-lg-6">
                        <label>Tuần bắt đầu</label>
                        <div class="col-lg-12">
                            <select class="select col-md-12" id="week_start" name="week_start"></select>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Tuần kết thúc</label>
                        <div class="col-lg-12">
                            <select class="select col-md-12" id="week_end" name="week_end"></select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-lg-6">
                        <label>Ngày bắt đầu</label>
                        <div class="col-lg-12">
                            <input type="text" placeholder="Ngày bắt đầu" name="date_start" id="date_start"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Ngày kết thúc</label>
                        <div class="col-lg-12">
                            <input type="text" placeholder="Ngày kết thúc" name="date_end" id="date_end"
                                class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Xóa</button>
                </div>
            </div>
            
        </div>
    </div>
</div>
</form>

@push('js')
    {{-- add timepicker --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            // set data for year
            let year = [];
            let startYear = new Date().getFullYear();
            let route_id = $('#route_from').val();
            for (let i = 0; i < 20; i++) {
                year.push({
                    id: i + startYear,
                    text: i + startYear
                });
            }
            $('#year').select2({
                placeholder: 'Chọn năm',
                tags: false,
                data: year
            });

            // set data for week-start and week-end
            let week = [{
                id:'',
                text:'Chọn tuần'
            }];
            for (let i = 1; i <= 53; i++) {
                week.push({
                    id: i,
                    text: "Tuần " + i
                });
            }
            $('#week_start').select2({
                placeholder: 'Chọn tuần bắt đầu',
                tags: true,
                data: week
            });
            $('#week_end').select2({
                placeholder: 'Chọn tuần kết thúc',
                tags: true,
                data: week
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

            // week change
            $('#week_start').on('change', function() {
                let week_start = $('#week_start').val();
                let year = $('#year').val();
                $.ajax({
                    url: '{{ route('admin.buses.apiGetDay') }}',
                    type: 'GET',
                    data: {
                        week_start: week_start,
                        year: year
                    },
                    success: function(res) {
                        $('#date_start').val(res);
                    }
                });
            });

            $('#week_end').on('change', function() {
                let week_start = $('#week_end').val();
                let year = $('#year').val();
                $.ajax({
                    url: '{{ route('admin.buses.apiGetDay') }}',
                    type: 'GET',
                    data: {
                        week_end: week_start,
                        year: year
                    },
                    success: function(res) {
                        $('#date_end').val(res);
                    }
                });
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
            $("#form").validate({
                    rules: {
                        year: {
                            required: true,
                        },
                        week_start: {
                            required: true,
                        },
                        week_end: {
                            required: true,
                        },
                        route_from: {
                            required: true,
                        }, 
                        route_to: {
                            required: true,
                        },
                    },
                    messages:{
                        year: {
                            required: 'Vui lòng chọn năm',
                        },
                        week_start: {
                            required: 'Vui lòng chọn tuần bắt đầu',
                        },
                        week_end: {
                            required: 'Vui lòng chọn tuần kết thúc',
                        },
                        route_from: {
                            required: 'Vui lòng chọn tuyến đi',
                        }, 
                        route_to: {
                            required: 'Vui lòng chọn tuyến về',
                        },
                    },
                    submitHandler: function(form) {
                        let confirm_delete = confirm('Bạn có chắc chắn muốn xóa?');
                        if(confirm_delete){
                            form.submit();
                        }
                    }
                });
        });
    </script>
@endpush
@endsection
