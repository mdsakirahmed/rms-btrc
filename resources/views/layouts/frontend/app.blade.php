<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8"/>
    <title>BTRC-RMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}"/>
    <script type='text/javascript' src='{{ asset('assets/frontend/js/jquery.particleground.js') }}'></script>
</head>

<body style="background-image: url('assets/frontend/images/background.jpg'); background-repeat: no-repeat; background-size: cover;">
<div id="particles">
    <div id="intro" style="height: 100%;">
        @yield('content')
    </div>
</div>
</body>
</html>
