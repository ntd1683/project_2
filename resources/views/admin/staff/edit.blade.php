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
                    <h4 class="card-title">Thêm Nhân Viên</h4>
                </div>
                    <div class="card-body">
                        <form action="{{route('admin.users.update',$user)}}" id="form-create-post" method="post">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tên</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Số điện thoại</label>
                                <div class="col-md-10">
                                    <input type="phone" class="form-control" name="phone" value="{{$user->phone}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Giới tính</label>
                                <div class="col-md-10 d-inline-flex">
                                    <div class="radio me-3">
                                        <label>
                                            <input type="radio" name="gender" value="1"
                                            @if($user->gender==1)
                                                checked
                                            @endif
                                            > Nam
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="0"
                                            @if($user->gender==0)
                                                checked
                                            @endif> Nữ
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Email</label>
                                <div class="col-md-10">
                                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Ngày sinh</label>
                                <div class="col-md-10">
                                    <input type="date" class="form-control" name="birthdate" onfocus="this.showPicker()" value="{{$user->birthdate}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Chức Vụ</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="level">
                                        @foreach($levels as $level=>$value)
                                            <option value="{{$value}}"
                                            @if($user->level === $value)
                                                selected
                                            @endif
                                            >{{$level}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row select-location">
                                <div class="col-md-4 mb-3">
                                    <label for="address">Địa Chỉ</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{$address_user[0]}}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="select-district">Quận/Huyện/Thành Phố</label>
                                    <select class="form-control" name="district" id="select-district">
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="select-city">Tỉnh</label>
                                    <select class="form-control" name="province" id="select-city">
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button class="btn btn-primary" type="submit" onclick="alert('Vui lòng chờ 5s !!! Cảm ơn')">Sửa Nhân Viên</button>
                                <a href="{{route('admin.users.show_users')}}" class="btn btn-link">Quay Lại</a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script>

            const city = '{{$address_user[2]}}';
            async function loadDistrict(parent) {
                parent.find("#select-district").empty();
                const path = parent.find("#select-city option:selected").data('path');
                if (!path) {
                    return;
                }
                const response = await fetch('{{ asset('locations/') }}' + path);
                const districts = await response.json();
                let string = '';
                const selectedValue = '{{$address_user[1]}}';
                // console.log(selectedValue);
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

                console.log(city);
                $("#select-city").select2({tags: true});
                const response = await fetch('{{ asset('locations/index.json') }}');
                const cities = await response.json();
                var string_1;
                $.each(cities, function (index, each) {
                    // $("#select-city").append(`
                // <option data-path='${each.file_path}'>
                //     ${index}
                // </option>`)

                    string_1 += `<option data-path='${each.file_path}'`;
                    if (city === index) {
                        string_1 += ` selected `;
                    }
                    string_1 += `>${index}</option>`;
                    $("#select-city").append(string_1);
                })
                $("#select-city").change(function () {
                    loadDistrict($(this).parents('.select-location'));
                });
                $('#select-district').select2({tags: true});
                await loadDistrict($('#select-city').parents('.select-location'));

                //validation
                jQuery.validator.addMethod('valid_name', function (value) {
                    var regex = /^[AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+ [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]+(?: [AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬBCDĐEÈẺẼÉẸÊỀỂỄẾỆFGHIÌỈĨÍỊJKLMNOÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢPQRSTUÙỦŨÚỤƯỪỬỮỨỰVWXYỲỶỸÝỴZ][aàảãáạăằẳẵắặâầẩẫấậbcdđeèẻẽéẹêềểễếệfghiìỉĩíịjklmnoòỏõóọôồổỗốộơờởỡớợpqrstuùủũúụưừửữứựvwxyỳỷỹýỵz]*)*$/;
                    return value.trim().match(regex);
                });
                jQuery.validator.addMethod('valid_phone', function (value) {
                    var regex = /^[\+|0]\d{1,13}$/;
                    return value.trim().match(regex);
                });
                $("#form-create-post").validate({
                    rules: {
                        name: {
                            required: true,
                            valid_name: true
                        },
                        phone: {
                            required: true,
                            digits: true,
                            valid_phone:true,
                        },
                        email: {
                            required:true,
                            email: true,
                        },
                        birthdate: {
                            required: true,
                            date: true,
                        },
                        level: {
                            min:0,
                            max:2,
                            required:true,
                        },
                        address:{
                            required:true,
                        }
                    },
                    messages:{
                        name: {
                            required: "Tên không được bỏ trống",
                            valid_name: "Tên không hợp lệ"
                        },
                        phone: {
                            required: "Số điện thoại không được bỏ trống",
                            digits: "Số nhập vào phải là số tự nhiên",
                            valid_phone:"Số điện thoại phải thuộc nhà mạng của Việt Nam"
                        },
                        email: {
                            required:"Email không được bỏ trống",
                            email: "Địa chỉ email không hợp lệ",
                        },
                        birthdate: {
                            required: "Ngày sinh không được bỏ trống",
                            date: "Dữ liệu nhập vào phải là ngày",
                        },
                        level: {
                            min:"Chức vụ không hợp lý",
                            max:"Chức vụ không hợp lý",
                            required:"Không được bỏ trống",
                        },
                        address:{
                            required:"Không được bỏ trống",
                        }
                    },
                    submitHandler: function (form) {
                        $(form).submit();
                    }
                });
            });
        </script>
    @endpush
@endsection
