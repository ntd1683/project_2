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
            <div class="col-auto text-right" 
                    style="
                position: absolute;
                right: 0;
                top: -61px;
                ">
            <a class="btn btn-white filter-btn" id="filter_search">
                <i class="fas fa-filter"></i>
            </a>
        </div>
    </div>
</div>

<div class="card filter-card" id="filter_inputs" style="display: block;">
    <div class="card-body pb-0">
            <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <form>
                            <div class="form-group">
                                <label for="level">Tên</label>
                                <select class="form-control select" name="name" id="name" style="text-align: center">
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <form>
                            <div class="form-group">
                                <label for="level">Điện thoại</label>
                                <select class="form-control select" name="phone" id="phone" style="text-align: center">
                                    
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <form>
                            <div class="form-group">
                                <label for="level">Email</label>
                                <select class="form-control select" name="email" id="email" style="text-align: center">
                                    
                                </select>
                            </div>
                        </form>
                    </div>
            </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0" id="table-data" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Xem</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>Giới tính</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày sinh</th>
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
            $(document).ready(function() {
                let table = $('#table-data').DataTable({
                        destroy: true,
                        dom: 'ltrp',
                        lengthMenu:[10,20,25,50,100],
                        select: true,
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.customers.api') !!}',
                        columns: [
                        { data: 'id', name: 'id' },
                        {
                            data: 'show',
                            render: function (data, type, row, meta) {
                                return `<a href="${data}" class="btn btn-sm bg-info-light"><i class="far fa-eye mr-1"></i> View</a>`;
                            } 
                        },
                        { data: 'name', name: 'name' },
                        { 
                            data: 'email', 
                            render: function (data, type, row, meta) {
                                return `<a href="mailto:${data}">${data}1</a>`;
                            } 
                        },
                        { 
                            data: 'phone', 
                            render: function (data, type, row, meta) {
                                return `<a href="tel:${data}">${data}1</a>`;
                            } 
                        },
                        { 
                            data: 'gender', 
                            render: function (data, type, row, meta) {
                                return data == 0 ? 'Nữ' : 'Nam';
                            } 
                        },
                        { data: 'address', name: 'address' },
                        { 
                            data: 'birthday',
                            render: function (data, type, row, meta) {
                                return data==null ? '' : moment(data).format('DD/MM/YYYY')
                            } 
                        },
                    ],
                });

                $('#name').select2({
                    ajax: {
                        url: "{{route('admin.customers.api.nameCustomers')}}",
                        dataType: 'json',
                        delay: 250,
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
                                        id: item.name,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Chọn tên',
                    allowClear:true,
                });

                $('#email').select2({
                    ajax: {
                        url: "{{route('admin.customers.api.emailCustomers')}}",
                        dataType: 'json',
                        delay: 250,
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
                                        text: item.email,
                                        id: item.email,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Chọn email',
                    allowClear:true,
                });

                $('#phone').select2({
                    ajax: {
                        url: "{{route('admin.customers.api.phoneCustomers')}}",
                        dataType: 'json',
                        delay: 250,
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
                                        text: item.phone,
                                        id: item.phone,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Chon tên',
                    allowClear:true,
                });

                $('#name').change(function () {
                    table.columns(2).search(this.value).draw();
                });
                $('#email').change(function () {
                    table.columns(3).search(this.value).draw();
                });
                $('#phone').change(function () {
                    table.columns(4).search(this.value).draw();
                });
            });
        </script>
    @endpush
@endsection