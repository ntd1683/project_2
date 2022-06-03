@extends('admin.layout.master')
@push('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">
    <style>
        ul.pagination > nav{
            position:absolute;
            top:0 !important;
            left:50% !important;
            transform: translateX(-50%)!important;
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
                <a class="btn btn-white filter-btn" href="javascript:void(0);" id="filter_search">
                    <i class="fas fa-filter"></i>
                </a>
            </div>
        </div>
    </div>
        {{--  Fillter  --}}
    <div class="card filter-card" id="filter_inputs">
        <div class="card-body pb-0">
            <form>
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Provider</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>From Date</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>To Date</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
{{-- End Filter --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0 datatable">
                            <thead>
                            <tr style="text-align: center">
                                <th>#</th>
                                <th>Tên</th>
                                <th>SĐT</th>
                                <th>Email</th>
                                <th>Ngày Sinh</th>
                                <th>Giới Tính</th>
                                <th>Đia Chỉ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $each)
                            <tr>
                                <td>{{$each->id}}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt="" src="{{asset($each->src_image_level)}}">
                                        </a>
                                        <a href="#">{{$each->name}}</a>
                                    </h2>
                                </td>
                                <td><a href="tel:{{$each->phone}}">{{$each->phone}}</a></td>
                                <td><a href="mailto:{{$each->email}}"
                                       class="__cf_email__">{{$each->email}}</a>
                                </td>
                                <td>{{$each->date_VN}}</td>
                                <td>{{$each->gender_name}}</td>
                                <td>{{$each->provinces}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <ul class="pagination position-relative">
                            {{$data->links()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{asset('plugins/datatables/sortasc.js')}}"></script>
    @endpush
@endsection
