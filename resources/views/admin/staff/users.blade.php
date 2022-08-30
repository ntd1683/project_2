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
    <div class="card filter-card" id="filter_inputs"  style="display: block;">
        <div class="card-body pb-0">
                <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <form>
                                <div class="form-group">
                                    <label for="level">Chức Vụ</label>
                                    <select class="form-control select" name="level" id="level" style="text-align: center">
                                        <option value="-1" Selected>Tất Cả</option>
                                        @foreach($levels as $level=>$value)
                                            <option value="{{$value}}">{{$level}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <form>
                                <div class="form-group">
                                    <label for="select-name">Tên</label>
                                    <select name="name" class="form-control select" style="text-align: center" id="select-name">
                                    </select>
                                </div>
                            </form>
                        </div>
                    <div class="col-sm-6 col-md-3">
                        <form>
                            <div class="form-group">
                                <label for="select-provinces">Vị Trí</label>
                                <select name="provinces" class="form-control select" style="text-align: center" id="select-provinces">
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
                                <th>Tên</th>
                                <th>SĐT</th>
                                <th>Email</th>
                                <th>Ngày Sinh</th>
                                <th>Giới Tính</th>
                                <th>Địa Chỉ</th>
                                <th>Chức Vụ</th>
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
                        url: "{{route('admin.users.api.name_users')}}",
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
                    placeholder: 'Nhập tên nhân viên',
                    allowClear:true
                });
                $("#select-provinces").select2({
                    ajax: {
                        url: "{{route('admin.users.api.provinces')}}",
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
                                    let str = item.address;
                                    let n = str.lastIndexOf(',');
                                    let result = str.substring(n + 1);
                                    return {
                                        text: result,
                                        id: result
                                    }
                                })
                            };
                        }
                    },
                    placeholder: 'Nhập địa chỉ',
                    allowClear:true
                });
                let table = $('#table-index').DataTable({
                    destroy: true,
                    dom: 'ltrp',
                    lengthMenu:[10,15,25,50,100],
                    select: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.users.api') !!}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {
                            data: 'name',
                            targets: 2,
                            orderable: true,
                            searchable: true,
                            render: function (data, type, row, meta) {
                                return `<h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            {{--// khi public lên website sẽ hiện thị đẹp hơn<img class="avatar-img rounded-circle" alt="" src="{{ public_path() }}/${data.src}">--}}
                                            <img class="avatar-img rounded-circle" alt="khi public lên website sẽ hiện thị đẹp hơn" src="{{ asset('images/user.png') }}">
                                        </a>
                                        <a href="#">${data.name}</a>
                                    </h2>`;
                            }
                        },
                        {
                            data: 'phone',
                            render: function (data, type, row, meta) {
                                return `<a href="tel:${data}">${data}1</a>`;
                            }
                        },
                        {
                            data: 'email',
                            render: function (data, type, row, meta) {
                                return `<a href="mailto:${data}">${data}1</a>`;
                            }
                        },
                        {data: 'birthdate', name: 'birthdate'},
                        {data: 'gender', name: 'gender'},
                        {data: 'address', name: 'address'},
                        {data: 'level', name: 'level'},
                        {
                            data: 'edit',
                            targets: 1,
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
                $('#level').change(function () {
                    let value = $(this).val();
                    table.columns(7).search(value).draw();
                });
                $('#select-name').change(function () {
                    table.columns(1).search(this.value).draw();
                });
                $('#select-provinces').change(function () {
                    table.columns(6).search(this.value).draw();
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
                                var reponse_heading;
                                var reponse_text;
                                var reponse_icon;
                                if(response.status){
                                    console.log(response.status);
                                    reponse_heading = 'Success';
                                    reponse_text = 'Chúc mừng !!! Bạn đã xoá thành công!';
                                    reponse_icon = 'success';
                                }
                                else if(!response.status){
                                    console.log(response.status);
                                    console.log('1');
                                    reponse_heading = 'Error';
                                    reponse_text = 'Bạn không thể xoá quản lý';
                                    reponse_icon = 'error';
                                }
                                $.toast({
                                    heading: reponse_heading,
                                    text: reponse_text,
                                    icon: reponse_icon,
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
