<!DOCTYPE html>

<html lang="en">
<head>
	@include('layouts.frontend.partials.head')
</head>

<body id="bg">

	<div class="page-wraper">

        <!-- HEADER START -->
        @include('layouts.frontend.partials.header')
        <!-- HEADER END -->

        <!-- CONTENT START -->
        <div class="page-content">

            @yield('content')

        </div>
        <!-- CONTENT END -->

        <!-- FOOTER START -->
        @include('layouts.frontend.partials.footer')
        <!-- FOOTER END -->


        <!-- BUTTON TOP START -->
        <button class="scroltop"><span class=" iconmoon-house relative" id="btn-vibrate"></span>Top</button>

        @include('layouts.frontend.partials.modal')

    </div>

<!-- LOADING AREA START ===== -->
<div class="loading-area">
    <div class="loading-box"></div>
    <div class="loading-pic">
        <div class="cssload-container">
            <div class="cssload-dot bg-primary"><i class="fa fa-bitcoin"></i></div>
            <div class="step" id="cssload-s1"></div>
            <div class="step" id="cssload-s2"></div>
            <div class="step" id="cssload-s3"></div>
        </div>
    </div>
</div>
<!-- LOADING AREA  END ====== -->
@include('layouts.frontend.partials.foot')

<!-- STYLE SWITCHER  ======= -->
@include('layouts.frontend.partials.styleswitcher')
<!-- STYLE SWITCHER END ==== -->

</body>
</html>
