<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title>Xe Thu Đức</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <script src="{{asset('js/jquery-3.6.0.min.js')}}" id="jquery_js"></script>
    <link rel="stylesheet"
          href="{{asset('css/css_index_customer.css')}}" />
    <script nonce="002d6f1d-ad20-47c0-8ae9-769b96dd12f5">
        (function (w, d) {
            !function (a, e, t, r) {
                a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zaraz = {deferred: []}, a.zaraz.q = [], a.zaraz._f = function (e) {
                    return function () {
                        var t = Array.prototype.slice.call(arguments);
                        a.zaraz.q.push({m: e, a: t})
                    }
                };
                for (const e of ["track", "set", "ecommerce", "debug"]) a.zaraz[e] = a.zaraz._f(e);
                a.addEventListener("DOMContentLoaded", (() => {
                    var t = e.getElementsByTagName(r)[0], z = e.createElement(r),
                        n = e.getElementsByTagName("title")[0];
                    for (n && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.w = a.screen.width, a.zarazData.h = a.screen.height, a.zarazData.j = a.innerHeight, a.zarazData.e = a.innerWidth, a.zarazData.l = a.location.href, a.zarazData.r = e.referrer, a.zarazData.k = a.screen.colorDepth, a.zarazData.n = e.characterSet, a.zarazData.o = (new Date).getTimezoneOffset(), a.zarazData.q = []; a.zaraz.q.length;) {
                        const e = a.zaraz.q.shift();
                        a.zarazData.q.push(e)
                    }
                    z.defer = !0, z.referrerPolicy = "origin", z.src = "../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(a.zarazData))), t.parentNode.insertBefore(z, t)
                }))
            }(w, d, 0, "script");
        })(window, document);
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,500;1,100&display=swap');
        html{
            scroll-behavior: smooth;
        }
    </style>
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">
    @stack('css')
</head>
<body>

{{--Plugin facebook lỗi @todo Lỗi Plugin Messenger--}}
<!-- Messenger Plugin chat Code -->
{{--<div id="fb-root"></div>--}}

<!-- Your Plugin chat code -->
{{--<div id="fb-customer-chat" class="fb-customerchat">--}}
{{--</div>--}}

{{--<script>--}}
{{--    var chatbox = document.getElementById('fb-customer-chat');--}}
{{--    chatbox.setAttribute("page_id", "105358328948144");--}}
{{--    chatbox.setAttribute("attribution", "biz_inbox");--}}
{{--</script>--}}

<!-- Your SDK code -->
{{--<script>--}}
{{--    window.fbAsyncInit = function() {--}}
{{--        FB.init({--}}
{{--            xfbml            : true,--}}
{{--            version          : 'v14.0'--}}
{{--        });--}}
{{--    };--}}

{{--    (function(d, s, id) {--}}
{{--        var js, fjs = d.getElementsByTagName(s)[0];--}}
{{--        if (d.getElementById(id)) return;--}}
{{--        js = d.createElement(s); js.id = id;--}}
{{--        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';--}}
{{--        fjs.parentNode.insertBefore(js, fjs);--}}
{{--    }(document, 'script', 'facebook-jssdk'));--}}
{{--</script>--}}

{{--End plugin messenger--}}

<!-- sidebar -->
@include('layout.sidebar')
<!-- endsidebar -->
<!-- content -->
@yield('content')
<!-- end content -->
<!--start footer -->
@include('layout.footer')
<!-- end footer -->

<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
    </svg></div>
{{--<script src="https://code.jquery.com/jquery-3.6.0.js"></script>--}}
<script src="{{asset('js/jquery-migrate-3.0.1.min.js%2bpopper.min.js%2bbootstrap.min.js.pagespeed.jc.g-lWZkHh9S.js')}}"></script>

<script>eval(mod_pagespeed_$690NsqoNN);</script>
<script>eval(mod_pagespeed_MP7PV5OAj7);</script>
<script>eval(mod_pagespeed_82gjmm9SQg);</script>
<script
    src="{{asset('js/jquery.easing.1.3.js%2bjquery.waypoints.min.js%2bjquery.stellar.min.js%2bowl.carousel.min.js.pagespeed.jc.50Xj_pEOKj.js')}}"></script>
<script>eval(mod_pagespeed_ZpVNjW1PfA);</script>
<script>eval(mod_pagespeed_3KxbDFl4e5);</script>
<script>eval(mod_pagespeed_bG_9rrDMl5);</script>
<script>eval(mod_pagespeed_3XzuUtEuOv);</script>
<script
    src="{{asset('js/jquery.magnific-popup.min.js%2baos.js%2bjquery.animateNumber.min.js%2bbootstrap-datepicker.js%2bscrollax.min.js%2bgoogle-map.js.pagespeed.jc.AC1cs65-6O.js')}}"></script>
{{--<script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>--}}
<script>eval(mod_pagespeed_RI2BEQZGxq);</script>
<script>eval(mod_pagespeed_jCfU0WKATb);</script>
<script>eval(mod_pagespeed_qYprJAbAOR);</script>
{{--<script id="datepicker_select">eval(mod_pagespeed_cXP3eADYe3);</script>--}}
<script>eval(mod_pagespeed_PXw0x0BHOQ);</script>
<script>eval(mod_pagespeed_Iwq$2YFlEZ);</script>
<script src="{{asset('js/main.js')}}"></script>
@stack('js')

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194"
        integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw=="
        data-cf-beacon='{"rayId":"708c9b2198921a46","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.12.0","si":100}'
        crossorigin="anonymous"></script>
</body>
</html>
