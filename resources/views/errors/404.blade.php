<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Truelysell | Template</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/favicon.png')}}">

    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.min.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body class="error-page">

<div class="main-wrapper">
    <div class="error-box">
        <h1>404</h1>
        <h3 class="h2"><i class="fas fa-exclamation-triangle"></i> Oops! Page not found!</h3>
        <p class="h4 font-weight-normal">The page you requested was not found.</p>
        <a href="@if(Illuminate\Support\Facades\Auth::check()){{route('admin.index')}}@endif
        @if(!Illuminate\Support\Facades\Auth::check()){{route('index')}}@endif" class="btn btn-primary">Back to Home</a>
    </div>
</div>


<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('js/admin.js')}}"></script>
</body>

</html>
