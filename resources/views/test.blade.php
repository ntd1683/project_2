<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ config('app.name') }} @isset($title)
            - {{$title}}
        @endisset
    </title>
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.toast.min.css')}}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,700;1,100&display=swap');
    </style>

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
</head>
<body>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0" id="table-test">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>License Plate</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/jquery.toast.min.js')}}"></script>
    
    <script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            let table = $('#table-test').DataTable({
                    destroy: true,
                    dom: 'ltrp',
                    select: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('api.test') !!}',
                    columns: [
                    { data: 'id', name: 'id' },
                    { data: 'license_plate', name: 'license_plate' },
                    { data: 'category', name: 'category' },
                    ],
            });
        });
    </script>
</body>
</html>