<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    {{-- custom styles --}}
    <link rel="stylesheet" href="{{ url('css/style.css') }}">

    {{-- link styles here --}}
    <link rel="stylesheet" href="{{ url('bootstrap-5.2.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('bootstrap-icons/font/bootstrap-icons.css') }}">
    <script src="{{ url('bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js') }}"></script>

</head>

<body class="bg p-md-5 p-2 center">
    {{-- content --}}
    <div class="container-900 text-center text-light">
        <h1>Hi there, this is the aclc school voting app</h1>
        <a href="{{ url('AdminLogin') }}">
            <button class="btn btn-light shadow-sm mt-2" type="button">
                Log as Admin
            </button>
        </a>
        
        <a href="{{ url('UserLogin') }}">
            <button class="btn btn-light shadow-sm mt-2" type="button">
                Log as User
            </button>
        </a>
    </div>
</body>

</html>
