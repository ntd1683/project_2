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
                <div class="card-header">
                    <h4 class="card-title">Thêm Địa Điểm Đón - Trả</h4>
                </div>
                    <div class="card-body">
                        <form action="{{route('admin.locations.store')}}" id="form-create-location" method="post" onsubmit="return false">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tên Địa Điểm Đón Trả</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="ví dụ : ngã 3 Eapốk">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Địa Chỉ</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Nhập địa chỉ cụ thể">
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
                                <button class="btn btn-primary" type="submit" id="btn-submit">Thêm Tuyến Xe</button>
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
            const city = $("#select-city").val();
            async function loadDistrict(parent) {
                parent.find("#select-district").empty();
                const path_tmp = parent.find("#select-city option:selected").data('path');
                let path = path_tmp.substr(1, path_tmp.length);
                if (!path) {
                    return;
                }
                const response = await fetch('{{ asset('locations/') }}' + path);
                const districts = await response.json();
                let string = '';
                const selectedValue = $("#select-district").val();
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
{{--            Load city--}}
            $(document).ready(async function () {
                $("#select-city").select2({tags: true});
                $("#select-city-2").select2({tags: true});
                const response = await fetch('{{ asset('locations/Index.json') }}');
                const cities = await response.json();
                $.each(cities, function (index, each) {
                    $("#select-city").append(`
                            <option data-path='${each.file_path}'>
                                ${index}
                            </option>`)
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
                $("#form-create-location").validate({
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
