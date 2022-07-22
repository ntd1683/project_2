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
                <a href="{{route('admin.carriages.create')}}" class="btn btn-white filter-btn add-button ml-3">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card filter-card" id="filter_inputs">
        <div class="card-body pb-0">
                <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <form>
                                <div class="form-group">
                                    <label for="level">License Plate</label>
                                    <select class="form-control" name="license_plate" id="license-plate" style="text-align: center">
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <form>
                                <div class="form-group">
                                    <label for="level">Carriage type</label>
                                    <select class="form-control select" name="carriage_type" id="carriage-type" style="text-align: center">
                                        <option value="">Tất cả</option>
                                        @foreach($categories as $categorie=>$value)
                                            <option value="{{$value}}">{{$categorie}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <form>
                                <div class="form-group">
                                    <label for="level">Seat type</label>
                                    <select class="form-control select" name="seat_type" id="seat-type" style="text-align: center">
                                        <option value="">Tất cả</option>
                                        @foreach($seatTypes as $seatType=>$value)
                                            <option value="{{$value}}">{{$seatType}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <form>
                                <div class="form-group">
                                    <label for="level">Number seat</label>
                                    <select class="form-control" name="number_seat" id="number-seat" style="text-align: center">
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
                                    <th>Bảng số xe</th>
                                    {{-- <th>Tuyến đường</th> --}}
                                    <th>Loại xe</th>
                                    <th>Loại ghế</th>
                                    <th>Số ghế</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
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
                $('#license-plate').select2({
                    ajax: {
                        url: "{{route('admin.carriages.api.nameCarriages')}}",
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
                                        text: item.license_plate,
                                        id: item.license_plate,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Chọn bảng số xe',
                    allowClear:true,
                });

                $('#number-seat').select2({
                    ajax: {
                        url: "{{route('admin.carriages.api.numberSeats')}}",
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
                                        text: item.default_number_seat,
                                        id: item.default_number_seat,
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Chọn số ghế xe',
                    allowClear:true,
                });


                let table = $('#table-data').DataTable({
                        destroy: true,
                        dom: 'ltrp',
                        lengthMenu:[5,10,20,25,50,100],
                        select: true,
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.carriages.api') !!}',
                        columns: [
                        { data: 'id', name: 'id' },
                        { data: 'license_plate', name: 'license_plate' },
                        // { data: 'route_name', name:'route_name'},
                        { data: 'category', name: 'category' },
                        { data: 'seat_type', name: 'seat_type' },
                        { data: 'default_number_seat', name: 'default_number_seat' },
                        {   
                            data: 'edit',
                            targets: 4,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                return `<a class="btn btn-success" href="${data}" style="color:white!important;">Edit</a>`;
                            }
                        },
                        {                             
                            data: 'delete',
                            targets: 5,
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

                // Delete element on table by ajax
                $(document).on('click', '#btn-delete', function(){
                    let confirm_delete = confirm('Bạn có chắc chắn muốn xóa?');
                    if(confirm_delete){
                        let form = $(this).parent('form');
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: form.serialize(),
                            datatype: 'json',
                            success: function(response){
                                $.toast({
                                    heading: response.heading,
                                    text: response.text,
                                    icon: response.icon,
                                    position: 'top-right',
                                    showHideTransition: 'slide',
                                });
                                // reload table with page present
                                table.ajax.reload(null, false);
                            }
                        });
                    }
                });

                $('#license-plate').change(function () {
                    table.columns(1).search(this.value).draw();
                });
                $('#carriage-type').change(function () {
                    table.columns(2).search(this.value).draw();
                });
                $('#seat-type').change(function () {
                    table.columns(3).search(this.value).draw();
                });
                $('#number-seat').change(function () {
                    table.columns(4).search(this.value).draw();
                });
            });
        </script>
    @endpush
@endsection