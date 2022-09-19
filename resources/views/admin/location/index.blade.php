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
                <a href="{{route('admin.locations.create')}}" class="btn btn-white filter-btn add-button ml-3">
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
                            <label for="select-name">Tên Địa Điểm Đón Trả</label>
                            <select name="name" class="form-control" style="text-align: center" id="select-name">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="select-address">Địa Chỉ</label>
                            <select name="address" class="form-control" style="text-align: center" id="select-address">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="select-district">Quận/Huyện/Thành Phố</label>
                            <select name="district" class="form-control" style="text-align: center" id="select-district">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="select-city">Tỉnh</label>
                            <select name="city" class="form-control" style="text-align: center" id="select-city">
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
                                <th>Tên Địa Điểm</th>
                                <th>Địa Chỉ</th>
                                <th>Quận / Huyện / Thành Phố</th>
                                <th>Tỉnh</th>
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

                $("#select-name").select2({
                    ajax: {
                        url: "{{route('admin.locations.api.name')}}",
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term, // search term
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
                    placeholder: 'Nhập tên địa chỉ đón - trả',
                    allowClear:true
                });

                $("#select-address").select2({
                    ajax: {
                        url: "{{route('admin.locations.api.address')}}",
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.address,
                                        id: item.address
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Nhập địa chỉ',
                    allowClear:true
                });

                $("#select-district").select2({
                    ajax: {
                        url: "{{route('admin.locations.api.district')}}",
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.district,
                                        id: item.district
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Nhập Quận/Huyện',
                    allowClear:true
                });

                $("#select-city").select2({
                    ajax: {
                        url: "{{route('admin.cities.api.city')}}",
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term, // search term
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
                    placeholder: 'Nhập Tỉnh',
                    allowClear:true
                });

                let table = $('#table-index').DataTable({
                    destroy: true,
                    dom: 'ltrp',
                    lengthMenu:[10,20,25,50,100],
                    select: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.locations.api') !!}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'address', name: 'address'},
                        {data: 'district', name: 'district'},
                        {data: 'city', name: 'city'},
                        {
                            data: 'edit',
                            targets: 5,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                               return `<a class="btn btn-sm bg-success-light mr-2" href="${data}"><i class="far fa-edit mr-1"></i>Edit</a>`;
                            }
                        },
                        {
                            data: 'destroy',
                            targets: 6,
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
                    table.columns(1).search(this.value).draw();
                });
                $('#select-address').change(function () {
                    table.columns(2).search(this.value).draw();
                });
                $('#select-district').change(function () {
                    table.columns(3).search(this.value).draw();
                });
                $('#select-city').change(function () {
                    table.columns(4).search(this.value).draw();
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
