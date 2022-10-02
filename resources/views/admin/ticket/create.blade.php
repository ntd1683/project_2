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
        span.select2-container{
            z-index:10000 !important;
        }

        #label-reverse,#label-pin{
            opacity:0.6;
        }
        #label-reverse:hover,#label-pin:hover{
            cursor: pointer;
            opacity:1;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <form action="{{route('admin.routes.store')}}" id="form-create-route" method="post" enctype="multipart/form-data" onsubmit="return false">
                    @csrf
                <div class="card-header">
                    <h4 class="card-title">Thêm Vé Xe</h4>
                </div>
                <div class="card-header">
                    <h5 class="card-title">Thông tin khách hàng</h5>
                </div>
                    <div class="card-body">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tên</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">SĐT</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Email</label>
                                <div class="col-md-10">
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Giới Tính</label>
                                <div class="col-md-10">
                                    <div class="col-md-10 d-inline-flex">
                                        <div class="radio me-3">
                                            <label>
                                                <input type="radio" name="gender" value="1" checked> Nam
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" value="0"> Nữ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="card-header">
                        <h5 class="card-title">Thông Tin Vé Xe</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Tuyến Đi</label>
                            <div class="col-md-10">
                                <select name="select-name-route" class="form-control" style="text-align: center" id="select-name-route">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Số Ghế</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="slot" id="slot">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Thời Gian Lên Xe</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Ảnh Hiện Thị</label>
                            <div class="col-md-10">
                                <input type="file" name="images" onchange="loadFile(event)">
                                <br>
                                <img id="output" width="200"  alt="Ảnh đã chọn"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button class="btn btn-primary" type="submit" id="btn-submit">Thêm Tuyến Xe</button>
                        <a href="{{route('admin.routes.index')}}" class="btn btn-link">Quay Lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script>
            let select_name_route;
            function select(){
                select_name_route = $("#select-name-route").val();
                console.log(select_name_route);
            }
            var loadFile = function(event) {
                var image = document.getElementById('output');
                image.src = URL.createObjectURL(event.target.files[0]);
            };
            let check ;
            function showError(notify) {
                $.toast({
                    heading: 'Error',
                    text: notify,
                    icon: 'error',
                    position: 'top-right',
                    showHideTransition: 'slide',
                });
            }

            function showSuccess(notify) {
                $.toast({
                    heading: 'Success',
                    text: notify,
                    icon: 'success',
                    position: 'top-right',
                    showHideTransition: 'slide',
                });
            }
            $(document).ready(async function () {
                $("#select-name-route").select2({
                    ajax: {
                        url: "{{route('admin.routes.api.name_routes')}}",
                        dataType: 'json',
                        data: function (params) {
                            select();
                            console.log('1');
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
                                        id: item.id
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Nhập tên tuyến đường',
                    allowClear:true
                });

                //validation
                $("#form-create-route").validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        city_start_id: {
                            required: true,
                        },
                        city_end_id: {
                            required: true,
                        },
                        time: {
                            required: true,
                        },
                        distance: {
                            required: true,
                        }
                    },
                    messages:{
                        name:{
                            required:"Không được bỏ trống",
                        },
                        city_start_id:{
                            required:"Không được bỏ trống",
                        },
                        city_end_id:{
                            required:"Không được bỏ trống",
                        },
                        time:{
                            required:"Không được bỏ trống",
                        },
                        distance:{
                            required:"Không được bỏ trống",
                        }
                    },
                    submitHandler:async function (form) {
                        checkCityStart();
                        checkCityEnd();
                        console.log('check');
                        if (check === true){
                            form.submit();
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
