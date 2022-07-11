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
                                    <label for="level">Route</label>
                                    <select class="form-control" name="route" id="route" style="text-align: center">
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
                        <table class="table table-hover table-center mb-0" id="table-data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bảng số xe</th>
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
                let table = $('#table-data').DataTable({
                        destroy: true,
                        dom: 'ltrp',
                        select: true,
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.carriages.api') !!}',
                        columns: [
                        { data: 'id', name: 'id' },
                        { data: 'license_plate', name: 'license_plate' },
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
            });
        </script>
    @endpush
@endsection