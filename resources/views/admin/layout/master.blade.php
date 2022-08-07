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

    @stack('css')
</head>
<body>
<div class="main-wrapper">

    <!-- start header -->
    @include('admin.layout.header')
    <!-- end header -->
    <!-- start sidebar -->
    @include('admin.layout.sidebar')
    <!-- end sidebar -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- start content -->
            <div class="page-header">
                <div class="row">
                    <div class="col-12">
                        <h3 class="page-title">@isset($title)
                                 {{$title}}
                            @endisset
                            {{$title_index ?? ''}}</h3>
                        @isset($breadcumbs)
                            {!! $breadcumbs !!}
                        @endisset
                    </div>
                </div>
            </div>
                @yield('content')
            <!-- end content -->
        </div>
    </div>
</div>

<!-- start footer -->
@include('admin.layout.footer')
<!-- end footer -->

<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/admin.js')}}"></script>
<script src="{{asset('js/jquery.toast.min.js')}}"></script>
<script>
    $(function() {
        @if ($errors->any())
            @foreach ($errors->all() as $error)
        $.toast({
            heading: 'Error',
            text: '{{ $error }}',
            icon: 'error',
            position: 'top-right',
            showHideTransition: 'slide',
        });
            @endforeach
        @endif
        @if (session()->has('success'))
        $.toast({
            heading: 'Import Success',
            text: '{{session()->get('success')}}',
            icon: 'success',
            position: 'top-right',
            showHideTransition: 'slide',
        });
        @endif
        @if (session()->has('error'))
        $.toast({
            heading: 'Error',
            text: '{{session()->get('error')}}',
            icon: 'error',
            position: 'top-right',
            showHideTransition: 'slide',
        });
        @endif
    });
    function notify(response) {
        $.toast({
            heading: response.success ? 'Thành công' : 'Lỗi',
            text: response.message,
            position: 'top-right',
            icon: response.success ? 'success' : 'error',
            showHideTransition: 'slide',
        });
    };
</script>
@stack('js')
</body>
</html>
