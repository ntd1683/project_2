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
                    <h4 class="card-title">Sửa thông tin Xe</h4>
                </div>
                    <div class="card-body">
                        <form action="{{route('admin.carriages.update',$carriage)}}" id="form-create-post" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Biển số xe</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="license_plate" value="{{$carriage->license_plate}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" for="select-category">Loại xe</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="category">
                                        @foreach($categories as $category=>$value)
                                            <option value="{{$value}}"
                                                @if ($carriage->category == $value)
                                                    selected
                                                @endif
                                            >{{$category}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" for="select-seat-type">Loại ghế ngồi</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="seat_type">
                                        @foreach($seatTypes as $seatType=>$value)
                                            <option value="{{$value}}"
                                            @if ($carriage->seat_type == $value)
                                                selected
                                            @endif
                                            >{{$seatType}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2" for="seat-number">Số lượng ghế</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="default_number_seat" value="{{$carriage->default_number_seat}}">
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <button class="btn btn-primary" type="submit">Sửa Thông Tin</button>
                                <a href="{{route('admin.carriages.show_cars')}}" class="btn btn-link">Quay Lại</a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
        <script>
            $(document).ready(async function() {
                //validation
                jQuery.validator.addMethod('valid_license_plate', function (value) {
                    var regex = /^[0-9]{1,2}-[A-Z0-9]{1,2}-[0-9]{4,5}$/;
                    return value.trim().match(regex);
                });

                $("#form-create-post").validate({
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
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });
            });
        </script>
    @endpush
@endsection
