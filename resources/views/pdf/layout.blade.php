<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>

    <style>
        /* body {
            background-image: url('../public/storage/Technocrats Icon.png');
        } */
        .d-none {
            display: none;
        }

        table,
        td,
        th {
            border: 1px solid;
        }

        td{
            font-size: 12px;
        }

        th {
            font-size: 14px;
        }

        hr {
            margin: 4px;
        }

        h1 {
            text-align: center;
        }

        h2 {
            margin: 5px;
        }

        .text-start {
            text-align: left;
        }

        th {
            height: 15px;
        }

        table.no-borders table,
        table.no-borders th,
        table.no-borders td {
            border: 0;
        }

        .no-borders {
            border: 0;
        }

        table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;

            margin-bottom: 15px;
        }

        p {
            margin: 0;
        }

        .txt-center {
            text-align: center;
        }

        .center {
            display: block;
            justify-content: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    {{-- header --}}
    <table class="no-borders">
        <tr>
            <td>
                <img src="{{ public_path('storage/images/aclc logo.png') }}" alt="" width="60">
                {{-- <img src="../aclc logo.png" alt="" width="60"> --}}
                {{-- <img src="{{ base_path('/public/aclc logo.jpg') }}" alt="" width="60"> --}}
                {{-- <img src="{{ asset('storage/images/aclc logo.jpg') }}" alt="" width="60"> --}}
                <p>ACLC College</p>
            </td>
            <td><h1>ACLC Voting Election 2023</h1></td>
            <td>
                <img src="{{ public_path('storage/Technocrats Icon.png') }}" alt="" width="60">
                {{-- <img src="{{ url('public/Technocrats Icon.png') }}" alt="" width="60"> --}}
                {{-- <img src="{{ asset('../storage/Technocrats Icon.png') }}" alt="" width="60"> --}}
                {{-- <img src="../public/storage/Technocrats Icon.png" alt="" width="60">  --}}
                <p>IT Department</p>
            </td>
        </tr>
    </table>

    <div style="width: 100%">
        @yield('content')
    </div>

    {{-- signatures --}}
    <table class="no-borders">
        <thead>

            <tr>
                <th colspan="2">
                    Signature:
                </th>
            </tr>
        </thead>
        
        <tr>
            <td>
                <br>
                <hr>
                Management Signature
            </td>
            <td>
                <br>
                <hr>
                Organizers Signature
            </td>
        </tr>
    </table>

    {{-- footer --}}
    <footer class="footer">
        <p>A pdf report ACLC IT Department : {{ date("l jS \of F Y h:i:s A") }}</p>
    </footer>
</body>

</html>
