<div class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <a href="{{route('admin.index')}}">
            <img src="{{asset('img/logo-icon.png')}}" class="img-fluid" alt="">
        </a>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li @if($route === 'index' || $route === 'admin' ||$route === 'profile')
                    class="active"
                @endif>
                    <a href="{{route('admin.index')}}"><i class="fas fa-columns"></i> <span>Trang Chủ</span></a>
                </li>
                <li @if($route === 'users')
                    class="active"
                    @endif>
                    <a href="{{route('admin.users.show_users')}}"><i class="fas fa-user-tie"></i> <span> Quản Lý Nhân Viên</span></a>
                </li>
                <li @if($route === 'routes')
                    class="active"
                    @endif>
                    <a href="{{route('admin.routes.index')}}"><i class="fas fa-road"></i> <span> Quản Lý Tuyến Đường</span></a>
                <li @if($route === 'carriages')
                    class="active"
                    @endif>
                    <a href="{{route('admin.carriages.index')}}"><i class="fas fa-bus"></i> <span> Quản Lý Xe</span></a>
                </li>
                <li @if($route === 'buses')
                    class="active"
                    @endif>
                    <a href="{{route('admin.buses.calendar')}}"><i class="fas fa-shuttle-van"></i> <span> Quản Lý Chuyến Xe</span></a>
                </li>
                <li @if($route === 'customers')
                    class="active"
                    @endif>
                    <a href="{{route('admin.customers.index')}}"><i class="fas fa-user"></i> <span> Quản Lý Khách Hàng</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
