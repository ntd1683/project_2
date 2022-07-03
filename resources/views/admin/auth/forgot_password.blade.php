<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ config('app.name') }} - Quên mật khẩu</title>
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>

<body>
<div class="main-wrapper">
    <div class="login-page">
        <div class="login-body container">
            <div class="loginbox">
                <div class="login-right-wrap">
                    <div class="account-header">
                        <div class="account-logo text-center mb-4">
                            <a href="{{route('admin.index')}}">
                                <img src="{{asset('img/logo-icon.png')}}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="login-header">
                        <h3><span>Quên Mật Khẩu?</span></h3>
                        <p class="text-muted">Nhập email của bạn để nhận liên kết đặt lại mật khẩu</p>
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Lỗi ! </strong> {{session()->get('error')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="border:0">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="card-header">
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <form method="post" action="{{route('admin.process_forgot_password')}}">
                        <div class="form-group mb-4">
                            <label class="control-label">Email</label>
                            <input class="form-control" type="email" placeholder="Nhập email của bạn" name="email" required>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-block account-btn" type="submit">Khôi phục mật khẩu</button>
                        </div>
                    </form>
                    <div class="text-center dont-have">Bạn đã nhớ mật khẩu? <a href="{{route('admin.login')}}">Đăng Nhập</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/admin.js')}}"></script>
</body>
</html>
