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
                <a href="{{route('admin.tickets.create')}}" class="btn btn-white filter-btn add-button ml-3">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    {{--  Fillter  --}}
    <div class="card filter-card" id="filter_inputs" style="display: block;">
        <div class="card-body pb-0">
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="select-phone">SĐT Khách Hàng</label>
                            <select name="phone_passenger" class="form-control" style="text-align: center" id="select-phone">
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 col-md-3">
                    <form>
                        <div class="form-group">
                            <label for="select-code">Mã vé</label>
                            <select name="code_ticket" class="form-control" style="text-align: center" id="select-code">
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
                                <th>SĐT khách hàng</th>
                                <th>Mã vé</th>
                                <th>Tên chuyến</th>
                                <th>Số ghế đặt</th>
                                <th>Giá</th>
                                <th>Phương thức thanh toán</th>
                                <th>Tình Trạng</th>
                                <th></th>
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
                //cái này đc nè ạ
                $("#select-phone").select2({
                    ajax: {
                        url: "{{route('admin.tickets.api.phone_passenger')}}",
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
                                        text: item.phone_passenger,
                                        id: item.phone_passenger
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Nhập tên nhân viên',
                    allowClear:true
                });
                //cái này lỗi nè ạ
                $("#select-code").select2({
                    ajax: {
                        url: "{{route('admin.tickets.api.code_tickets')}}",
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data.map(item  => {
                                    return {
                                        text: item.code,
                                        id: item.code
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Nhập mã vé',
                    allowClear:true
                });

                let table = $('#table-index').DataTable({
                    order: [[1, 'desc']],
                    destroy: true,
                    dom: 'ltrp',
                    lengthMenu:[10,20,25,50,100],
                    select: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.tickets.api') !!}',
                    columns: [
                        {
                            data: 'show',
                            targets: 0,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                return `<a class="btn btn-info" href="${data}" style="color:white!important;">Xem</a>`;
                            }
                        },
                        {data: 'id_ticket', name: 'id_ticket'},
                        {data: 'phone_passenger', name: 'phone_passenger'},
                        {data: 'code_ticket', name: 'code'},
                        {data: 'route_name', name: 'route_name'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'price', name: 'price'},
                        {data: 'payment_method', name: 'payment_method'},
                        {data: 'status', name: 'status'},
                        {
                            data: 'edit',
                            targets: 7,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                return `<a class="btn btn-success" href="${data}" style="color:white!important;">Sửa</a>`;
                            }
                        },
                    ],
                });
                $('#select-phone').change(function () {
                    table.columns(2).search(this.value).draw();
                });
                $('#select-code').change(function () {
                    table.columns(3).search(this.value).draw();
                });
            });
        </script>
    @endpush
@endsection
