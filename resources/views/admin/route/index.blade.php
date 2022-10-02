@extends('admin.layout.master')
@push('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables/datatables.min.css')}}">
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
                <a href="{{route('admin.routes.create')}}" class="btn btn-white filter-btn add-button ml-3">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    {{--  Fillter  --}}
    <div class="card filter-card" id="filter_inputs"  style="display: block;" style="display: block;">
        <div class="card-body pb-0">
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="select-name">Tên</label>
                            <select name="name" class="form-control" style="text-align: center" id="select-name">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="select-name">Điểm Đi</label>
                            <select name="city_start_id" class="form-control" style="text-align: center" id="select-city-start-id">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="select-name">Điểm Về</label>
                            <select name="city_end_id" class="form-control" style="text-align: center" id="select-city-end-id">
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Filter --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- thiếu class datatable-->
                        <table class="table table-hover table-center mb-0" id="table-index" style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Xem</th>
                                <th>Điểm Đi</th>
                                <th>Điểm Đến</th>
                                <th>Tên</th>
                                <th>Thời Gian</th>
                                <th>Khoảng Cách</th>
                                <th>Sửa</th>
                                <th>Xoá</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
        <script>
            let select_name = $("#select-name").val();
            let select_city_start_id = $("#select-city-start-id").val();
            let select_city_end_id = $("#select-city-end-id").val();
            function select(){
                select_name = $("#select-name").val();
                select_city_start_id = $("#select-city-start-id").val();
                select_city_end_id = $("#select-city-end-id").val();
                console.log(select_name,select_city_start_id,select_city_end_id);
            }
            $(document).ready(function(){

                $("#select-name").select2({
                    ajax: {
                        url: "{{route('admin.routes.api.name_routes')}}",
                        dataType: 'json',
                        data: function (params) {
                            select();
                            return {
                                q: params.term, // search term
                                city_start : select_city_start_id,
                                city_end : select_city_end_id,
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        id: item.name
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Nhập tên tuyến đường',
                    allowClear:true
                });
                $("#select-city-start-id").select2({
                    ajax: {
                        url: "{{route('admin.routes.api.city_start')}}",
                        dataType: 'json',
                        data: function (params) {
                            select();
                            return {
                                q: params.term, // search term
                                route_name : select_name,
                                city_end : select_city_end_id,
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
                    placeholder: 'Nhập điểm đi',
                    allowClear:true
                });

                $("#select-city-end-id").select2({
                    ajax: {
                        url: "{{route('admin.routes.api.city_end')}}",
                        dataType: 'json',
                        data: function (params) {
                            select();
                            return {
                                q: params.term, // search term
                                route_name : select_name,
                                city_start : select_city_start_id,
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
                    placeholder: 'Nhập điểm đến',
                    allowClear:true
                });

                let table = $('#table-index').DataTable({
                    destroy: true,
                    dom: 'ltrp',
                    lengthMenu:[5,10,20,25,50,100],
                    select: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.routes.api') !!}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {
                            data: 'show',
                            targets: 0,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                return `<a href="${data}" class="btn btn-sm bg-info-light"><i class="far fa-eye mr-1"></i> View</a>`;
                            }
                        },
                        {data: 'city_start', name: 'city_start'},
                        {data: 'city_end', name: 'city_end'},
                        {data: 'name', name: 'name'},
                        {data: 'time', name: 'time'},
                        {data: 'distance', name: 'distance'},
                        {
                            data: 'edit',
                            targets: 7,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                               return `<a class="btn btn-sm bg-success-light mr-2" href="${data}"><i class="far fa-edit mr-1"></i>Edit</a>`;
                            }
                        },
                        {
                            data: 'destroy',
                            targets: 8,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                return `<form action="${data}" method="post">
                                    @csrf
                                @method('DELETE')
                                <button type='button' class="btn btn-sm bg-danger-light mr-2 delete_review_comment" id="btn-delete" ><i class="far fa-trash-alt mr-1"></i>Delete</button>
                                </form>`;
                            }
                        },
                    ],
                });
                $('#select-name').change(function () {
                    select();
                    table.columns(4).search(this.value).draw();
                });
                $('#select-city-start-id').change(function () {
                    select();
                    table.columns(2).search(this.value).draw();
                });
                $('#select-city-end-id').change(function () {
                    select();
                    table.columns(3).search(this.value).draw();
                });
                $(document).on('click','#btn-delete',function(){
                    let confirm_delete = confirm("Bạn có chắc muốn xoá không ?");
                    if (confirm_delete === true) {
                        let form = $(this).parents('form');
                        $.ajax({
                            type: "POST",
                            url: form.attr('action'),
                            data: form.serialize(),
                            dataType: "json",
                            success: function (response) {
                                $.toast({
                                    heading: 'success',
                                    text: 'Chúc mừng !!! Bạn đã xoá thành công!',
                                    icon: 'success',
                                    position: 'top-right',
                                    showHideTransition: 'slide',
                                });
                                table.draw();
                            },
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
