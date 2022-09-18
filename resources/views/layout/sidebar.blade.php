<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}#book_ticket">Đặt<span>Vé Xe Ngay</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item @if($url == "")
                    active
@endif"><a href="{{route('index')}}" class="nav-link">Trang Chủ</a></li>
                <li class="nav-item"><a href="destination.html" class="nav-link">Vận tải hàng hoá</a></li>
                <li class="nav-item @if($url == "tuyen-duong")
                    active
@endif"><a href="{{route('applicant.schedule')}}" class="nav-link">Tuyến Đường</a></li>
                <li class="nav-item @if($url == "dat-ve-xe")
                    active
@endif"><a href="#" class="nav-link">Chuyến Đi</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">Tin tức</a></li>
                <li class="nav-item @if($url == "kiem-tra-ve")
                    active
@endif"><a href="{{route('applicant.check_ticket')}}" class="nav-link">Kiểm Tra Vé</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Liên Hệ</a></li>
                <!-- <li class="nav-item cta"><a href="#" class="nav-link">Book Now</a></li> -->
            </ul>
        </div>
    </div>
</nav>
