@extends('admin.layout.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('plugins/themify-icons/themify-icons.css')}}">
    <style>
        span.select2-container{
            z-index:10000 !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-auto profile-image">
                        <a href="#">
                            {{--// khi public lên website sẽ hiện thị đẹp hơn<img class="rounded-circle" alt="User Image" src="{{ public_path() }}/${data.src}">--}}
                            <img class="rounded-circle" alt="User Image"
                                 src="{{asset('images/admin.png')}}">
                        </a>
                    </div>
                    <div class="col ml-md-n2 profile-user-info">
                        <h4 class="user-name mb-0">{{$user->name}}</h4>
                        <div class="user-Location"><i class="fas fa-map-marker-alt"></i>{{$address_user[2]}},Việt Nam</div>
                    </div>
                </div>
            </div>
            <div class="profile-menu">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab_about" href="#per_details_tab" onclick="show_profile()">Thông Tin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab_password" href="#password_tab" onclick="show_password()">Đổi Mật Khẩu</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content profile-tab-cont">

                <div class="tab-pane fade show active" id="per_details_tab">

                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Personal Details</span>
                                    <a class="edit-link" href="#edit_personal_details"
                                       data-bs-toggle="modal" data-bs-target="#edit_personal_details">
                                        <i class="far fa-edit mr-1"></i>Edit
                                    </a>
                                </h5>
                                <div class="row">
                                    <p class="col-sm-3 text-muted text-end mb-0 mb-sm-3">Tên</p>
                                    <p class="col-sm-9">{{$user->name}}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-3 text-muted text-end mb-0 mb-sm-3">Ngày Sinh
                                    </p>
                                    <p class="col-sm-9">{{$user->date_VN}}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-3 text-muted text-end mb-0 mb-sm-3">Email</p>
                                    <p class="col-sm-9">{{$user->email}}
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-3 text-muted text-end mb-0 mb-sm-3">Số Điện Thoại</p>
                                    <p class="col-sm-9">{{$user->phone}}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-3 text-muted text-end mb-0">Địa Chỉ</p>
                                    <p class="col-sm-9 mb-0">{{$address_user[0]}},<br>
                                        {{$address_user[1]}}, <br>
                                        {{$address_user[2]}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="edit_personal_details" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Chỉnh Sửa Thông Tin Cá Nhân</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('admin.update_profile',$user)}}" id="form-update-user" method="post">
                                            <div class="row form-row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tên</label>
                                                        <input type="text" class="form-control"
                                                               value="{{$user->name}}" name="name">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Ngày Sinh</label>
                                                        <div class="cal-icon">
                                                            <input type="date" class="form-control"
                                                                   value="{{$user->birthdate}}" onfocus="this.showPicker()" name="birthdate">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
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
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control"
                                                               value="{{$user->email}}" name="email">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Số Điện Thoại</label>
                                                        <input type="text" value="{{$user->phone}}"
                                                               class="form-control" name="phone">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <h5 class="form-title"><span>Địa Chỉ</span></h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Số nhà</label>
                                                        <input type="text" class="form-control"
                                                               value="{{$address_user[0]}}" name="address">
                                                    </div>
                                                </div>
                                                <div class="select-location form-row" style="z-index:99 !important">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="select-district">Huyện/Quận/Thành Phố</label>
                                                            <select class="form-control" name="district" id="select-district">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="select-city">Tỉnh</label> <br>
                                                            <select class="form-control" name="province" id="select-city">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block" onclick="alert('Vui lòng chờ 5s !!!')"> Sửa Đổi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="password_tab" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body" style="text-align:center">
                            <h5 class="card-title">Change Password</h5>
                            <div class="row" style="justify-content:center">
                                <div class="col-md-10 col-lg-6">
                                    <form action="{{route('admin.change_password',$user)}}" id="form-change-password" method="post">
                                        <div class="form-group" style="position:relative">
                                            <label>Old Password</label>
                                            <input id="old_password" type="password" class="form-control" name="old_password" style="text-align:center;font-size: 25px;">
                                            <i class="ti-eye" onclick="show_inp_password()"></i>
                                        </div>
                                        <div class="form-group" style="position:relative">
                                            <label>New Password</label>
                                            <input id="new_password" type="password" class="form-control" name="new_password" style="text-align:center;font-size: 25px;">
                                            <i class="ti-eye" onclick="show_inp_password1()"></i>
                                        </div>
                                        <div class="form-group" style="position:relative">
                                            <label>Confirm Password</label>
                                            <input id="confirm_password" type="password" class="form-control" name="confirm_password" style="text-align:center;font-size: 25px;">
                                            <i class="ti-eye" onclick="show_inp_password2()"></i>
                                        </div>
                                        <button class="btn btn-primary" type="submit" onclick="alert('Đợi mình 5s nhé !!!')">Đổi Mật Khẩu</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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

            $password = document.getElementById('password_tab');
            $profile = $('#per_details_tab');
            $tab_about = document.querySelector('[data-toggle="tab_about"]');
            $tab_password = document.querySelector('[data-toggle="tab_password"]');
            $edit_personal = document.getElementById("edit_personal_details");

            function show_password(){
                $password.classList.add('show');
                $password.classList.add('active');
                $profile.removeClass('active');
                $profile.removeClass('show');
                $tab_about.classList.remove('active');
                $tab_password.classList.add('active');
            }

            function show_profile(){
                $profile.addClass('active');
                $profile.addClass('show');
                $password.classList.remove('show');
                $password.classList.remove('active');
                $tab_about.classList.add('active');
                $tab_password.classList.remove('active');
            }

            function show_inp_password(){
                let password = $("#old_password");
                if(password.attr("type") === "password"){
                    password.attr("type","text");
                }
                else{
                    password.attr("type","password");
                }
            }
            function show_inp_password1(){
                let password = $("#new_password");
                if(password.attr("type") === "password"){
                    password.attr("type","text");
                }
                else{
                    password.attr("type","password");
                }
            }
            function show_inp_password2(){
                let password = $("#confirm_password");
                if(password.attr("type") === "password"){
                    password.attr("type","text");
                }
                else{
                    password.attr("type","password");
                }
            }

            $(document).ready(async function () {

                //city
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
                $("#form-update-user").validate({
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
                        address:{
                            required:"Không được bỏ trống",
                        }
                    },
                    submitHandler: function (form) {
                        $(form).submit();
                    }
                });

                $("#form-change-password").validate({
                    rules: {
                        old_password: {
                            required: true,
                        },
                        new_password: {
                            required: true,
                        },
                        confirm_password: {
                            required:true,
                            equalTo: "#new_password"
                        },
                    },
                    messages:{
                        old_password: {
                            required: "Mật khẩu cũ không được bỏ trống",
                        },
                        new_password: {
                            required: "Mật khẩu mới không được bỏ trống",
                        },
                        confirm_password: {
                            required:"Mật khẩu nhập lại không được bỏ trống",
                            equalTo: "Nhập không khớp",
                        },
                    },
                    submitHandler: function (form) {
                        $(form).submit();
                    }
                });
            });
        </script>
    @endpush
@endsection
