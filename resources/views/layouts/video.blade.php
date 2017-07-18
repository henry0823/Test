<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- Title -->
<title>LIVE</title>
<!-- CSS Plugins -->
<link rel="stylesheet" href="/css/plugins-bundle.css" />
<!-- CSS Icons -->
<link rel="stylesheet" href="/css/icons-bundle.css" />
<link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="/plugins/flag-icon-css/css/flag-icon.min.css" />
<!-- CSS Theme -->
<link id="theme" rel="stylesheet" href="/css/themes/slab/theme_orange-blue.min.css" />
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body>
<!-- Header -->
<header id="header">
    <!-- Navigation -->
    <nav id="nav-main">
        <ul class="nav nav-main-vertical">
            <li><a href="/live"><i class="li-home"></i>首頁</a></li>
            <li class="more"><a href="#" data-toggle="nav-additional"><i class="li-laptop"></i>直播</a></li>
        </ul>
    </nav>
</header>
<!-- Header / End -->

<!-- Content -->
<div id="content">
    <!-- Section / Intro -->
    <section id="intro" class="section fullheight dark bg-primary">
        <div class="container-custom">
            @yield('content')
        </div>
    </section>
</header>
<!-- Content / End -->

<!-- Header Mobile -->
<header id="header-mobile">
    <!-- Nav Toggle -->
    <a href="#" id="nav-toggle"><span></span><span></span><span></span><span></span></a>
</header>

<!-- Navigation Additional -->
<nav id="nav-additional" class="bg-dark dark">
    <!-- 賽事列表 -->
    @foreach($sports as $key => $s)
        <h5 id="{{ $key }}" style="margin-bottom:5px; margin-top:10px;">{{ $s }}</h5>
        @if($channel[$key] != null)
            <!-- 直播頻道 -->
            @foreach($channel[$key] as $c)
                <div style="display:none" id="channel{{ $key }}">
                    <a href="/live/{{ $s }}/{{ $c['zbTitle'] }}">
                    &nbsp&nbsp&nbsp{{ $c['zbTitle'] }}</a>
                </div>
            @endforeach
        @else
            <div style="display:none" id="channel{{ $key }}">&nbsp&nbsp&nbsp目前無直播</div>
        @endif
    @endforeach
</nav>

<!-- Notification Bar -->
<div id="notification-bar"></div>

<!-- Modal / Video -->
<div class="modal modal-video fade" id="modalVideo" role="dialog">
    <button class="close" data-dismiss="modal"><i class="ti-close"></i></button>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <iframe height="500"></iframe>
        </div>
    </div>
</div>

@foreach($sports as $key => $s)
    <script>
    $(document).ready(function(){
        $("#{{ $key }}").click(function(){
            $("[id=channel{{ $key }}]").toggle();
        });
    });
    </script>
@endforeach

<!-- JS Plugins -->
<script src="/plugins/jquery/dist/jquery.min.js"></script>
<script src="/plugins/tether/dist/js/tether.min.js"></script>
<script src="/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/plugins/slick-carousel/slick/slick.min.js"></script>
<script src="/plugins/jquery.appear/jquery.appear.js"></script>
<script src="/plugins/jquery.scrollto/jquery.scrollTo.min.js"></script>
<script src="/plugins/jquery.localscroll/jquery.localScroll.min.js"></script>
<script src="/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="/plugins/waypoints/lib/shortcuts/sticky.min.js"></script>
<script src="/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/plugins/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.min.js"></script>
<script src="/plugins/masonry-layout/dist/masonry.pkgd.min.js"></script>
<script src="/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/plugins/twitter-fetcher/js/twitterFetcher_min.js"></script>
<script src="/plugins/skrollr/dist/skrollr.min.js"></script>

<!-- JS Core -->
<script src="/js/core.js"></script>

</body>

</html>
