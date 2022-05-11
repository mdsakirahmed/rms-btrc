<html>
    <head>
        <title>PDF</title>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <img src="https://mdsakir.com/web-storage/btrc-logo-light.png" alt="BTRC Logo" style="height: 80px; weight: 80px; margin-right: 25px;">
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
