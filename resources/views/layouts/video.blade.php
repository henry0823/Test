<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- Title -->
<title>Video</title>
<!-- CSS Plugins -->
<link rel="stylesheet" href="/css/plugins-bundle.css" />
<!-- CSS Icons -->
<link rel="stylesheet" href="/css/icons-bundle.css" />
<link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="/plugins/flag-icon-css/css/flag-icon.min.css" />
<!-- CSS Theme -->
<link id="theme" rel="stylesheet" href="/css/themes/slab/theme_orange-blue.min.css" />

<body>
<!-- Header -->
<header id="header">
    <!-- Navigation -->
    <nav id="nav-main">
        <ul class="nav nav-main-vertical">
            <li><a href="#intro"><i class="li-home"></i>Start</a></li>
            <li><a href="#product"><i class="li-laptop"></i>Product</a></li>
            <li><a href="#features"><i class="li-vote"></i>Features</a></li>
            <li><a href="#reviews"><i class="li-feedback"></i>Reviews</a></li>
            <li><a href="#contact"><i class="li-email"></i>Contact</a></li>
            <li class="more"><a href="#" data-toggle="nav-additional"><i class="li-gift"></i>Live</a></li>
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
    @foreach($sports as $s)
        <h6><a href="/live/{{ $s }}">{{ $s }}</a></h6>
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


<!-- JS Google Map -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
</body>

</html>
