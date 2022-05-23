<html>
    <head>
        <title>{{ $file_name }}</title>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <img src="assets/frontend/images/logo-light.png" alt="BTRC Logo" style="height: 80px; weight: 80px; margin-right: 25px;">
                </td>
                <td>
                    <h3>Bangladesh Telecommunication Regulatory Commission</h3>
                    <p>IRB Bhaban, Ramna, Dhaka-1000</p>
                    <br>
                </td>
            </tr>
        </table>
        <br>
        <hr>
        <br>
        <h1 style="text-align:center;">{{ $file_name }}</h1>
        @yield('content')
    </body>
</html>
