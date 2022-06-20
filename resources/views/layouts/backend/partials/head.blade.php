{{-- <base href="{{ url('/') }}"> --}}
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="{{ config('app.name') }}">
<meta name="author" content="{{ config('app.name') }}">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
<title>{{ $title ?? 'Page' }} | {{ config('app.name') }}</title>
<link href="{{ asset('assets/node_module_files/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Custom CSS -->
<link href="{{ asset('assets/dist/css/style.min.css') }}" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="{{ asset('assets/helper/helper.css') }}" rel="stylesheet" type="text/css" />
<!--====== AJAX ======-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@toastr_css
@stack('head')

<style>
    .required:after {
        content: " * ";
        color: red;
        font-size: 18px;
    }

    .sidebar-nav ul {
        background-color: #f5fff6;
        color: #474847;

    }

    .sidebar-nav ul li a {
        background-color: #f5fff6;
        color: #474847;
        margin-top: -5px;
        border-top: 1px solid #e5f8e7;
    }

    .sidebar-nav>ul>li.active>a {
        color: #208837;
        font-weight: 500;
        border-left: 3px solid #208837;
    }

    .sidebar-nav ul li a.active,
    .sidebar-nav ul li a:hover {
        color: #208837;
    }

    .sidebar-nav>ul>li.active>a i {
        color: #208837;
    }

    .sidebar-nav ul li a.active i,
    .sidebar-nav ul li a:hover i {
        color: #208837;
    }

    .nav-link {
        color: #208837;
    }

    .btn-primary {
        color: white;
        background-color: #208837;
        border-color: #208837;
    }

    .btn-primary:hover {
        color: white;
        background-color: rgba(32, 136, 55, 0.85);
        border-color: #208837;
    }

     /*Scroll bar style start */
     /*width*/
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #2088364a;
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #208837;
    }

    .left-sidebar {
        overflow: scroll;
        overflow-x: hidden;
    }

    /* Scroll bar style end */

    .btrc{
        background-color: #208837;
        color: white;
    }

    table {
            white-space: nowrap;
            font-size: 12px;
    }



</style>
