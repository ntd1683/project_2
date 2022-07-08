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
                <a href="{{route('admin.users.create')}}" class="btn btn-white filter-btn add-button ml-3">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    {{--  Fillter  --}}
    <div class="card filter-card" id="filter_inputs">
        <div class="card-body pb-0">
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="level">Chức Vụ</label>
                            <select class="form-control select-filter" name="level" id="level" style="text-align: center">
                                <option value="-1" Selected>Tất Cả</option>
                            </select>
                        </div>
                    </form>
                </div>
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
                            <label for="select-provinces">Vị Trí</label>
                            <select name="provinces" class="form-control" style="text-align: center" id="select-provinces">
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
                                <th></th>
                                <th>#</th>
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
            $(document).ready(function(){
                let table = $('#table-index').DataTable({
                    destroy: true,
                    dom: 'ltrp',
                    lengthMenu:[5,10,20,25,50,100],
                    select: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.routes.api') !!}',
                    columns: [
                        {
                            data: 'show',
                            targets: 0,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                return `<a class="btn btn-info" href="${data}" style="color:white!important;">Show</a>`;
                            }
                        },
                        {data: 'id', name: 'id'},
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
                                return `<a class="btn btn-success" href="${data}" style="color:white!important;">Edit</a>`;
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
                                <button type='button' class="btn btn-danger" id="btn-delete" >Delete</button>
                            </form>`;
                            }
                        },
                    ],
                });
            });
        </script>
    @endpush
@endsection
