@extends('admin.layout.master')
@push('css')
    <link rel="stylesheet" href="{{asset('plugins/fullcalendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        ul.pagination {
            margin-bottom: 1rem!important;
            justify-content: center!important;
        }
        .select2-container{
            display:block!important;
        }
        table.table td a:hover {
            color: #ff0080;
        }
        .error{
            color: red !important;
        }
    </style>
@endpush
@section('content')
    <div class="page-header">
        <div class="row" style="position:relative">
            <div class="col-auto text-right" style="
    position: absolute;
    right: 0;
    top: -61px;
">
                <a class="btn btn-white filter-btn" id="filter_search">
                    <i class="fas fa-filter"></i>
                </a>
                <a class="btn btn-white filter-btn add-button ml-3" id="add_btn">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    {{--  Add  --}}
    <div class="card filter-card" id="add_show" style="display: none;" >
        <div class="card-body">
            <div class="justify-content-center text-center">
                <a href="{{route('admin.buses.create')}}">
                    <button type="button" class="btn btn-primary btn-lg submit-btn">
                    Tạo Mới</button>
                </a>
                <a href="{{route('admin.buses.quickCreate')}}">
                    <button type="button" class="btn btn-info btn-lg submit-btn" style="color: #ffffff;">
                    Tạo Nhanh</button>
                </a>
                <a href="{{route('admin.buses.quickDelete')}}">
                    <button type="button" class="btn btn-danger btn-lg submit-btn">
                    Xóa nhanh</button>
                </a>
            </div>
        </div>
    </div>
    {{-- End Add --}}
    {{-- Filter --}}
    {{-- <div class="card filter-card" id="filter_inputs">
        <div class="card-body pb-0">
            <div class="row filter-row">     
                <div class="col-sm-6 col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="level">Route</label>
                            <select class="form-control" style="text-align: center">
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- End Filter --}}

    {{-- nav tab --}}
    <ul class="nav nav-tabs menu-tabs">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('admin.buses.calendar')}}">Lịch trình</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.buses.index')}}">Danh sách</a>
        </li>
    </ul>
    {{-- End nav tab --}}

    {{-- calendar --}}
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <h5 class="card-title">Tuyến đường</h5>
            <div class="row filter-row">                        
                {{-- Filter time --}}
                {{-- End Filter time --}}
                <div class="mb-3">
                    <form>
                        <div class="form-group">
                            <select class="form-control" name="route" id="route" style="text-align: center">
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{route('admin.routes.create')}}" class="btn mb-3 btn-primary justify-content-center d-flex">
                Thêm Tuyến Đường
            </a>
            <h5 class="card-title">Xe</h5>
            <div id="license-plate" class="mb-3">
            </div>
            <button type="button" data-toggle="modal" data-target="#add_new_event" id="add_car"
                class="btn col-lg-12 btn-primary justify-content-center d-flex">
                Thêm Xe
            </button>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- End calendar --}}

    <div class="modal fade none-border" id="my_event">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="route_event"></h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class='btn btn-success save-event submit-btn'>Save</button>
                    <button type="button" class="btn btn-success create-event submit-btn">Create</button>
                    <button type="button" class="btn btn-danger delete-event submit-btn"
                        data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="carriages">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="form-carriages" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Biển số xe</label>
                            <input type="text" class="form-control form-white" name="license_plate" id="license_plate" placeholder="Ví dụ: 22-T9-9999">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label>Loại xe</label>
                                <select class="form-control" name="category" id="category">
                                    @foreach($categories as $category=>$value)
                                        <option value="{{$value}}">{{$category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Loại ghế</label>
                                <select class="form-control" name="seat_type" id="seat_type">
                                    @foreach($seatTypes as $seatType=>$value)
                                        <option value="{{$value}}">{{$seatType}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label>Số lượng ghế</label>
                                <input type="number" class="form-control" name="default_number_seat" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Giá</label>
                                <input type="number" class="form-control" name="price" id="price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tài xế</label>
                            <select class="form-control select" name="driver" id="driver">
                            </select>
                        </div>
                        <div class="form-group mb-0">
                            <label>Choose Category Color</label>
                            <select class="form-control form-white" data-placeholder="Choose a color..."
                                name="category-color">
                                <option value="success">Success</option>
                                <option value="danger">Danger</option>
                                <option value="info">Info</option>
                                <option value="primary">Primary</option>
                                <option value="warning">Warning</option>
                                <option value="inverse">Inverse</option>
                            </select>
                        </div>
                        <div class="submit-section">
                            <button type="button" class='btn btn-success save-car submit-btn'>Save</button>
                            <button type="button" class="btn btn-success create-car submit-btn"
                                data-dismiss="modal">Create</button>
                            <button type="button" class="btn btn-danger delete-car submit-btn"
                                data-dismiss="modal">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{asset('js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('plugins/fullcalendar/fullcalendar.min.js')}}"></script>
        <script src="{{asset('plugins/fullcalendar/jquery.fullcalendar.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script>
            let modal_carriages = $('#carriages');
            let form_carriages = $('#form-carriages')
            let calendar_event = $('#license-plate');
            let route_id;
            let route_id_inverse;

            $(document).on('click', '#add_btn', function() {
                $('#add_show').slideToggle("slow");
            });

            let validateCarriages = function(){
                form_carriages.validate({
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
                        price: {
                            required: true,
                            number: true,
                            min: 0,
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
                        price: {
                            required: "Vui lòng nhập giá",
                            number: "Vui lòng nhập số",
                            min: "Giá phải lớn hơn 0",
                        },
                    },
                });
            };

            let submitAddFormCarriages = function(){
                $.ajax({
                    url: form_carriages.attr('action'),
                    type: form_carriages.attr('method'),
                    data: $(form_carriages).serialize() + '&route_from=' + route_id + '&route_to=' + route_id_inverse,
                    success: function(response) {
                        let text = form_carriages.find("input[name='license_plate']").val();
                        carriages_html = `<div class="calendar-events" data-class="bg-info" value="${response.id}" style="cursor: pointer;"><i class="fas fa-circle text-info"></i> ${text} </div>`;
                        calendar_event.append(carriages_html);
                        let elements = document.getElementsByClassName("calendar-events");
                        elements[elements.length-1].addEventListener('click', editCarFunction, false);
                        $.CalendarApp.enableDrag();
                        notify(response);
                        modal_carriages.modal('hide');
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
            };

            let submitEditFormCarriages = function(){
                $.ajax({
                    url: form_carriages.attr('action'),
                    type: form_carriages.attr('method'),
                    data: $(form_carriages).serialize() + '&route_from=' + route_id + '&route_to=' + route_id_inverse,
                    success: function(response) {
                        notify(response);
                        modal_carriages.modal('hide');
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
            };

            let editCarFunction = function(){
                let $this = this;
                let car_id = this.getAttribute("value");
                form_carriages.trigger('reset');
                let action = "{!! route('admin.carriages.updateCarAndRDC','') !!}"+"/"+ car_id;
                form_carriages.attr('action', action);
                modal_carriages
                    .modal({
                        backdrop: 'static'
                    })
                    .find('.modal-title').text('Sửa xe').end()
                    .find('.create-car').hide().end()
                    .find('.delete-car').show().end()
                    .find('.save-car').show().end()
                    .modal('show')
                    .find('.close').click(function () {
                        modal_carriages.modal('hide');
                    });

                $.ajax({
                    url: "{{route('admin.carriages.api.carriageByID')}}",
                    type: "GET",
                    dataType: "json",
                    data: {
                        car_id: car_id,
                    },
                    success: function(response) {
                        form_carriages.find("input[name='license_plate']").val(response.license_plate);
                        form_carriages.find("select[name='category']").val(response.category);
                        form_carriages.find("select[name='seat_type']").val(response.seat_type);
                        form_carriages.find("input[name='price']").val(response.price);
                        form_carriages.find("input[name='default_number_seat']").val(response.default_number_seat);
                        $('#driver').select2('trigger', 'select', {
                            data: {
                                id: response.driver_id,
                                text: response.name
                            }
                        });
                    }
                });
                modal_carriages.find('.save-car').unbind('click').click(function () {
                    if(form_carriages.valid()){
                        submitEditFormCarriages();
                    }
                });

                modal_carriages.find('.delete-car').unbind('click').click(function () {
                    let confirm_delete_car = confirm('Bạn có chắc chắn muốn xóa?');
                    if (confirm_delete_car) {
                        var form_delete = $("<form action='" + "{!! route('admin.carriages.destroy','') !!}"+"/" + car_id + "' method='POST'></form>");
                        form_delete.append("<input type='hidden' name='_method' value='DELETE' />");
                        $.ajax({
                            url: form_delete.attr('action'),
                            type: "POST",
                            dataType: "json",
                            data: form_delete.serialize(),
                            success: function(response) {
                                $this.remove();
                                notify(response);
                                modal_carriages.modal('hide');
                            },
                            error: function(response) {
                                notify(response.responseJSON);
                            }
                        });
                    };
                });
            };

            let addCarFunction = function(){
                form_carriages.trigger('reset');
                $('#driver').select2('trigger', 'select', {
                    data: {
                        id: '',
                        text: ''
                    }
                });

                modal_carriages
                    .modal({
                        backdrop: 'static'
                    })
                    .find('.modal-title').text('Thêm xe').end()
                    .find('.delete-car').hide().end()
                    .find('.save-car').hide().end()
                    .find('.create-car').show().end()
                    .modal('show')
                    .find('.close').click(function () {
                        modal_carriages.modal('hide');
                    });

                form_carriages.attr('action', "{{route('admin.carriages.store')}}");
                modal_carriages.find('.create-car').unbind('click').click(function () {
                    if(form_carriages.valid()){
                        submitAddFormCarriages();  
                    }
                });
                    
            };

            $(document).ready(function() {
                jQuery.validator.addMethod('valid_license_plate', function (value) {
                    var regex = /^[0-9]{1,2}-[A-Z0-9]{1,2}-[0-9]{4,5}$/;
                    return value.trim().match(regex);
                });
                // select2 route
                let route = $('#route').select2({
                    ajax: {
                        url: "{{route('admin.routes.api.name_routes')}}",
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function (data) {

                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Tuyến đường',
                    allowClear:true,
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
                    allowClear:true,
                    dropdownParent: modal_carriages
                });

                // get first route and set route selected
                let route_event = $('#route_event');
                $.ajax({
                    url: "{{route('admin.routes.api.apiGetFirstRoute')}}",
                    dataType: 'json',
                    success: function(data) {
                        route.select2('trigger', 'select', {
                            data: {
                                text: data.name,
                                id: data.id
                            }
                        });
                        route_id = data.id;
                        route_event.text('').val('');
                        route_event.text(data.name).val(data.id);
                    }
                });

                // select route change
                $('#route').change(function(){
                    route_id = $(this).val();
                    route_name = $(this).find(':selected').text();
                    route_event.text('').val('');
                    route_event.text(route_name).val(route_id);
                    if(route_id == null){
                        route_id = 0;
                    }
                    // load ajax carriages
                    $.ajax({
                        url: "{{route('admin.carriages.api.nameCarriages')}}",
                        dataType: 'json',
                        data: {
                            route_id: route_id,
                        },
                        success: function(data) {
                            let carriages_html = '';
                            calendar_event.html('');
                            $.each(data, function(index, value) {
                                carriages_html = `<div class="calendar-events" data-class="bg-info" value="${value.id}" style="cursor: pointer;"><i class="fas fa-circle text-info"></i> ${value.license_plate} </div>`;
                                calendar_event.append(carriages_html);
                            });
                            $.CalendarApp.enableDrag();

                            var elements = document.getElementsByClassName("calendar-events");

                            for (var i = 0; i < elements.length; i++) {
                                elements[i].addEventListener('click', editCarFunction, false);
                            }
                        }
                    });
                    $.ajax({
                        url: '{{ route('admin.routes.apiGetRouteInverse') }}',
                        type: 'GET',
                        data: {
                            route: route_id
                        },
                        success: function(res) {
                            route_id_inverse=res.id;
                        }
                    });

                    // load ajax event
                    $.ajax({
                        url: '{{route('admin.buses.api.calendar')}}',
                        type: 'GET',
                        data: {
                            route_id: route_id,
                        },
                        success: function(data){
                            data.map(function(item){
                                    item.eventId = item.id;
                                    item.start = item.departure_time;
                                    item.end = moment(item.departure_time).add(30, 'minutes').format('YYYY-MM-DD HH:mm:ss');
                                    item.title = item.license_plate;
                                    item.className = 'bg-info';
                                });
                            $.CalendarApp.$calendarObj.fullCalendar('removeEvents');
                            $.CalendarApp.$calendarObj.fullCalendar('addEventSource', data);
                        }
                    });
                });
                // Validate carriages
                validateCarriages();

                // Add carriages
                $('#add_car').click(function(){
                    addCarFunction();
                })

            });
        </script>
    @endpush
@endsection