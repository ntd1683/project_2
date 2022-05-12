<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Xe Thu Đức</title>

    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">

    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body>
<div class="main-wrapper">

    <!-- start header -->
    @include('layout.header')
    <!-- end header -->

    <!-- start sidebar -->
    @include('layout.sidebar')
    <!-- end sidebar -->

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <!-- start content -->
                        <h3 class="page-title">Blank Page</h3>
                        <!-- end content -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- start footer -->
@include('layout.footer')
<!-- end footer -->

<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>

<script src="{{asset('plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>

<script src="{{asset('js/select2.min.js')}}"></script>

<script src="{{asset('js/admin.js')}}"></script>
</body>
</html>
