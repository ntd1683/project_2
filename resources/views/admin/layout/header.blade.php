
<div class="header">
    <div class="header-left">
        <a href="{{route('admin.index')}}" class="logo logo-small">
            <img src="{{asset('img/logo-icon.png')}}" alt="Logo" width="30" height="30">
        </a>
    </div>
    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fas fa-align-left"></i>
    </a>
    <a class="mobile_btn" id="mobile_btn" href="javascript:void(0);">
        <i class="fas fa-align-left"></i>
    </a>
    <ul class="nav user-menu">

        <li class="nav-item dropdown noti-dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <i class="far fa-bell"></i> <span class="badge badge-pill"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="admin-notification.html">
                                <div class="media">
<span class="avatar avatar-sm">
<img class="avatar-img rounded-circle" alt="" src="{{asset('img/provider/provider-01.jpg')}}">
</span>
                                    <div class="media-body">
                                        <p class="noti-details">
                                            <span class="noti-title">Thomas Herzberg have been subscribed</span>
                                        </p>
                                        <p class="noti-time">
                                            <span class="notification-time">15 Sep 2020 10:20 PM</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="admin-notification.html">
                                <div class="media">
<span class="avatar avatar-sm">
<img class="avatar-img rounded-circle" alt="" src="{{asset('img/provider/provider-02.jpg')}}">
</span>
                                    <div class="media-body">
                                        <p class="noti-details">
                                            <span class="noti-title">Matthew Garcia have been subscribed</span>
                                        </p>
                                        <p class="noti-time">
                                            <span class="notification-time">13 Sep 2020 03:56 AM</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="admin-notification.html">
                                <div class="media">
<span class="avatar avatar-sm">
<img class="avatar-img rounded-circle" alt="" src="{{asset('img/provider/provider-03.jpg')}}">
</span>
                                    <div class="media-body">
                                        <p class="noti-details">
                                            <span class="noti-title">Yolanda Potter have been subscribed</span>
                                        </p>
                                        <p class="noti-time">
                                            <span class="notification-time">12 Sep 2020 09:25 PM</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="admin-notification.html">
                                <div class="media">
<span class="avatar avatar-sm">
<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('img/provider/provider-04.jpg')}}">
</span>
                                    <div class="media-body">
                                        <p class="noti-details">
                                            <span class="noti-title">Ricardo Flemings have been subscribed</span>
                                        </p>
                                        <p class="noti-time">
                                            <span class="notification-time">11 Sep 2020 06:36 PM</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="admin-notification.html">
                                <div class="media">
<span class="avatar avatar-sm">
<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('img/provider/provider-05.jpg')}}">
</span>
                                    <div class="media-body">
                                        <p class="noti-details">
                                            <span class="noti-title">Maritza Wasson have been subscribed</span>
                                        </p>
                                        <p class="noti-time">
                                            <span class="notification-time">10 Sep 2020 08:42 AM</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="admin-notification.html">
                                <div class="media">
<span class="avatar avatar-sm">
<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('img/provider/provider-06.jpg')}}">
</span>
                                    <div class="media-body">
                                        <p class="noti-details">
                                            <span class="noti-title">Marya Ruiz have been subscribed</span>
                                        </p>
                                        <p class="noti-time">
                                            <span class="notification-time">9 Sep 2020 11:01 AM</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="admin-notification.html">
                                <div class="media">
<span class="avatar avatar-sm">
<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('img/provider/provider-07.jpg')}}">
</span>
                                    <div class="media-body">
                                        <p class="noti-details">
                                            <span class="noti-title">Richard Hughes have been subscribed</span>
                                        </p>
                                        <p class="noti-time">
                                            <span class="notification-time">8 Sep 2020 06:23 AM</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="admin-notification.html">View all Notifications</a>
                </div>
            </div>
        </li>


        <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle user-link  nav-link" data-bs-toggle="dropdown">
<span class="user-img">
<img class="rounded-circle" src="{{asset('img/user.jpg')}}" width="40" alt="Admin">
</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="admin-profile.html">Profile</a>
                <a class="dropdown-item" href="{{route('admin.logout')}}">Logout</a>
            </div>
        </li>
    </ul>
</div>
