<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Nhà Xe Thu Đức | Login</title>
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/themify-icons/themify-icons.css')}}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,700;1,100&display=swap');
    </style>
</head>
<body>
<div class="main-wrapper">
    <div class="login-page">
        <div class="login-body container">
            <div class="loginbox">
                <div class="login-right-wrap">
                    <div class="account-header">
                        <div class="account-logo text-center mb-4">
                            <a href="index.html">
                                <img src="{{asset('img/logo-icon.png')}}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="login-header">
                        <h3><span>Đăng Nhập</span></h3>
                        <p class="text-muted">Để vào trang tổng quan</p>
                    </div>
                    <form action="https://truelysell-admin.dreamguystech.com/template/index.html">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input class="form-control" type="email" placeholder="Vui lòng nhập email" name="email">
                        </div>
                        <div class="form-group mb-4" style="position:relative">
                            <label class="control-label">Mật khẩu</label>
                            <input class="form-control" type="password" placeholder="Vui lòng nhập mật khẩu" name="password" id="password">
                            <i class="ti-eye" onclick="show_password()"></i>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-block account-btn" type="submit">Đăng Nhập</button>
                        </div>
                    </form>
                    <div class="text-center forgotpass mt-4"><a href="{{route('admin.forgot_password')}}">Quên mật khẩu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/admin.js')}}"></script>
<script>
    function show_password(){
        let password = $("#password");
        if(password.attr("type") === "password"){
            password.attr("type","text");
        }
        else{
            password.attr("type","password");
        }
    }
</script>
</body>
</html>
