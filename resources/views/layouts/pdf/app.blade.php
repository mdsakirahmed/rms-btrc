<html>
<head>
    <title>{{ $file_name }}</title>
    <style>
        table {
            white-space: nowrap;
            font-size: 12px;
        }

        @media print {
            .table{
                border-collapse: collapse;
            }
    
            .table tr td{
                border: 1px solid #ccc;
                padding: 5px;
               
            }
    
            .table tr:last-child td{
                border: 1px solid white;
            } 
        }
    </style>
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
    <htmlpagefooter name="footer">
        <p style="text-align:center;">Claiming the document is computer generated and hence, does not require any signature</p>
    </htmlpagefooter>
    <sethtmlpagefooter name="footer" value="on" />
</body>
</html>
