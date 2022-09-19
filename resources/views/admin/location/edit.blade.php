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
            z-index:1 !important;
        }
        span.select2-container.select2-container--default.select2-container--open{
            z-index:10000000 !important;
        }

        #label-pin{
            opacity:0.6;
        }
        #label-pin:hover{
            cursor: pointer;
            opacity:1;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sửa Địa Điểm Đón - Trả</h4>
                </div>
                    <div class="card-body">
                        <form action="{{route('admin.locations.update',$location)}}" id="form-update-location" method="post" onsubmit="return false">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tên Địa Điểm Đón Trả</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="ví dụ : ngã 3 Eapốk" value="{{$location->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Địa Chỉ</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Nhập địa chỉ cụ thể" value="{{$location->address}}">
                                </div>
                            </div>
                            <div class="form-row select-location">
                                <div class="col-6">
                                    <label for="select-district">Quận/Huyện/Thành Phố</label>
                                    <select class="form-control" name="district" id="select-district">
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="select-city">Tỉnh</label>
                                    <select class="form-control" name="city" id="select-city">
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button class="btn btn-primary" type="submit" id="btn-submit">Sửa Địa Điểm Đón - Trả</button>
                                <a href="{{route('admin.locations.index')}}" class="btn btn-link">Quay Lại</a>
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
                                    <select class="form-control" name="name" id="select-city-2">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block" onclick="submitForm()">Thêm thành phố</button>
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
            const city_name = '{{$city_name}}';
            const district = '{{$location->district}}';
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

            function test(){
                console.log($("#select-city").val());
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
            const city = $("#select-city").val();
            {{--            Load city--}}

            async function loadDistrict(parent) {
                parent.find("#select-district").empty();
                const path = parent.find("#select-city option:selected").data('path');
                if (!path) {
                    return;
                }
                const response = await fetch('{{ asset('locations/') }}' + path);
                const districts = await response.json();
                let string = '';
                const selectedValue = '{{$location->district}}';
                console.log(selectedValue);
                $.each(districts.district, function (index, each) {
                    if (each.pre === 'Quận' || each.pre === 'Huyện'||each.pre === 'Thành phố') {
                        string += `<option`;
                        if (selectedValue === each.name) {
                            string += ` selected `;
                        }
                        string += `>${each.name}</option>`;
                    }
                })
                parent.find("#select-district").append(string);
            }
            $(document).ready(async function () {
                $("#select-city").select2({tags: true});
                $("#select-city-2").select2({tags: true});
                const response = await fetch('{{ asset('locations/index.json') }}');
                const cities = await response.json();
                var string_city;
                var string_end;
                $.each(cities, function (index, each) {
                    string_city += `<option data-path='${each.file_path}'`;
                    if (city_name === index) {
                        string_city += ` selected `;
                    }
                    string_city += `>${index}</option>`;
                    $("#select-city").append(string_city);
                    $("#select-city").append(`
                <option data-path='${each.file_path}'>
                    ${index}
                </option>`);
                    $("#select-city-2").append(`
                            <option data-path='${each.file_path}'>
                                ${index}
                            </option>`)
                })
                $("#select-city").change(function () {
                    loadDistrict($(this).parents('.select-location'));
                });
                $('#select-district').select2({tags: true});
                await loadDistrict($('#select-city').parents('.select-location'));
                function checkCity() {
                    $.ajax({
                        url: '{{ route('admin.cities.check') }}/' + $("#select-city").val(),
                        type: 'GET',
                        dataType: 'json',
                        success: async function (response) {
                            if (response.data) {
                                $("#modal-city").modal("hide");
                                check = true;
                            } else {
                                $("#modal-city").modal("show");
                                $("#select-city-2").val($("#select-city").val()).trigger('change');
                                check = false;
                            }
                        }
                    });
                }

                //validation
                $("#form-update-location").validate({
                    rules: {
                        address: {
                            required: true,
                        },
                        district: {
                            required: true,
                        },
                    },
                    messages:{
                        address:{
                            required:"Không được bỏ trống",
                        },
                        district:{
                            required:"Không được bỏ trống",
                        },
                    },
                    submitHandler:async function (form) {
                        checkCity();
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
