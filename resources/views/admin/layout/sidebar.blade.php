<div class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <a href="index.html">
            <img src="{{asset('img/logo-icon.png')}}" class="img-fluid" alt="">
        </a>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li @if($route === 'admin')
                    class="active"
                @endif>
                    <a href="{{route('admin.index')}}"><i class="fas fa-columns"></i> <span>Trang Chủ</span></a>
                </li>
                <li @if($route === 'users')
                    class="active"
                    @endif>
                    <a href="{{route('admin.users.show_user')}}"><i class="fas fa-user-tie"></i> <span> Quản Lý Nhân Viên</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
