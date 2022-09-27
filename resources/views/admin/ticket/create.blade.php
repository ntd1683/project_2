@extends('admin.layout.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script>
        function callbackThen(response){
            response.json().then(function(data) {
                console.log(data);
            })
        }
        function callbackCatch(error){
            console.log('error: ' + error);
        }
    </script>
    <meta name="csrf_token" content="{{csrf_token()}}">
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
    {!! htmlScriptTagJsApi([
        'callback_then'=>'callbackThen',
        'callback_catch'=>'callbackCatch',
    ]) !!}
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm Vé Xe</h4>
                </div>
                    <div class="card-body">
                        <form action="{{route('admin.routes.store')}}" id="form-create-route" method="post" enctype="multipart/form-data" onsubmit="return false">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Điểm Đến</label>
                                <div class="col-md-10">
                                    <select name="city_start_id" class="form-control" id="city_start_id"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Điểm Đi</label>
                                <div class="col-md-10">
                                    <select name="city_end_id" class="form-control" id="city_end_id"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tên</label>
                                <div class="col-md-10">
                                    <input type="text" readonly class="form-control" name="name" id="name" placeholder="Click điểm đi , điểm đến để hiện thị tên">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Thời Gian Đi (Đơn vị giờ)</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="time">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Khoảng Cách</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="distance" id="distance">
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
                            <div class="form-group row">
                                <div class="col-md-10">
                                    <div class="checkbox">
                                        <label for="pin" id="label-pin">
                                            <input type="checkbox" name="pin" id="pin"> Bạn có muốn ghim tuyến này không ?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10">
                                    <div class="checkbox">
                                        <label for="reverse" id="label-reverse">
                                            <input type="checkbox" name="reverse" id="reverse"> Bạn có muốn tạo tuyến ngược lại không
                                        </label>
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
    </div>
    <div class="modal fade" id="modal-city" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Thành Phố Hoạt Động ( chưa có trong danh sách )</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.cities.store')}}" id="form-create-city" method="post">
                        @csrf
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tên Thành Phố</label>
                                    <select class="form-control" name="name" id="select-city">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block" onclick="submitForm()"> Sửa Đổi</button>
{{--                            <button type="submit" class="btn btn-primary btn-block"> Sửa Đổi</button>--}}
                        </div>
{{--                    </form>--}}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script>
            function mySubmitFunction(e) {
                e.preventDefault();
                someBug();
                return false;
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



            function submitForm() {
                alert('Vui lòng chờ 5s !!!');
                const obj = $("#form-create-city");
                const formData = new FormData(obj[0]);
                sessionStorage.setItem('key', 'value');
                $.ajax({
                    url: "{{route('admin.cities.store')}}",
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    async: false,
                    cache: false,
                    success: function (response) {
                        if (response.success) {
                            $("#modal-city").modal("hide");
                            showSuccess('Thêm city thành công');
                        } else {
                            showError(response.message);
                        }
                    },
                    error: function (response) {
                        let errors;
                        if (response.responseJSON.errors) {
                            errors = Object.values(response.responseJSON.errors);
                            showError(errors);
                        } else {
                            errors = response.responseJSON.message;
                            showError(errors);
                        }
                    }
                });
            }
{{--            Load city--}}
            $(document).ready(async function () {
                $("#city_start_id").select2({tags: true});
                $("#select-city").select2({tags: true});
                $("#city_end_id").select2({tags: true});
                const response_start = await fetch('{{ asset('locations/index.json') }}');
                const cities_start = await response_start.json();
                $.each(cities_start, function (index, each) {
                    $("#city_start_id").append(`
                <option data-path='${each.file_path}'>
                    ${index}
                </option>`)
                    $("#select-city").append(`
                <option data-path='${each.file_path}'>
                    ${index}
                </option>`)
                    $("#city_end_id").append(`
                <option data-path='${each.file_path}'>
                    ${index}
                </option>`)
                });
                function generateName(){
                    city_start = $("#city_start_id").val();
                    city_end = $("#city_end_id").val();
                    let name = city_start + ' - ' + city_end;
                    $("#name").val(name);
                }

                function checkCityStart() {
                    $.ajax({
                        url: '{{ route('admin.cities.check') }}/' + $("#city_start_id").val(),
                        type: 'GET',
                        dataType: 'json',
                        success: async function (response) {
                            if (response.data) {
                                $("#modal-city").modal("hide");
                                check = true;
                            } else {
                                $("#modal-city").modal("show");
                                $("#select-city").val($("#city_start_id").val()).trigger('change');
                                check = false;
                            }
                        }
                    });
                }
                function checkCityEnd() {
                    $.ajax({
                        url: '{{ route('admin.cities.check') }}/' + $("#city_end_id").val(),
                        type: 'GET',
                        dataType: 'json',
                        success: async function (response) {
                            if (response.data) {
                                $("#modal-city").modal("hide");
                                check = true;
                            } else {
                                $("#modal-city").modal("show");
                                $("#select-city").val($("#city_end_id").val()).trigger('change');
                                check = false;
                            }
                        }
                    });
                }
                let city_start = $("#city_start_id").val();
                let city_end = $("#city_end_id").val();

                $("#city_start_id, #city_end_id").change(function () {
                    generateName();
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
