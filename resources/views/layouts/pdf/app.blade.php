<html>
    <head>
        <title>PDF</title>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <img src="http://119.148.13.153:8092/assets/frontend/images/logo-light.png" alt="BTRC Logo" style="height: 80px; weight: 80px; margin-right: 25px;">
                </td>
                <td>
                    <h3>Bangladesh Telecommunication Regulatory Commission</h3>
                    <p>IRB Bhaban, Ramna, Dhaka-1000</p>
                    <br>
                    <h4>{{ $file_name }}</h4>
                </td>
            </tr>
        </table>
        <br>
        <hr>
        <br>
        @yield('content')
    </body>
</html>
