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
                    <h4 class="user-name mb-0">
                        {{$customer->name}}
                    </h4>
                    <div class="user-Location"><i class="fas fa-map-marker-alt"></i>
                        {{$customer->address}}, Việt Nam
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content profile-tab-cont">

            <div class="tab-pane fade show active" id="per_details_tab">

                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between">
                                <span>Thông tin chi tiết</span>
                            </h5>
                            <div class="row">
                                <p class="col-sm-3 text-muted text-end mb-0 mb-sm-3">Tên</p>
                                <p class="col-sm-9">
                                    {{$customer->name}}
                                </p>
                            </div>
                            <div class="row">
                                <p class="col-sm-3 text-muted text-end mb-0 mb-sm-3">Ngày Sinh
                                </p>
                                <p class="col-sm-9">
                                    {{$customer->date_VN}}
                                </p>
                            </div>
                            <div class="row">
                                <p class="col-sm-3 text-muted text-end mb-0 mb-sm-3">Email</p>
                                <p class="col-sm-9">
                                    <a href="mailto:{{$customer->email}}" style="color: black">{{$customer->email}}</a>
                                </p>
                            </div>
                            <div class="row">
                                <p class="col-sm-3 text-muted text-end mb-0 mb-sm-3">Số Điện Thoại</p>
                                <p class="col-sm-9">
                                    <a href="tel:{{$customer->phone}}" style="color: black">{{$customer->phone}}</a>
                                </p>
                            </div>
                            <div class="row">
                                <p class="col-sm-3 text-muted text-end mb-0">Địa Chỉ</p>
                                <p class="col-sm-9 mb-0">
                                    {{$customer->address}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
