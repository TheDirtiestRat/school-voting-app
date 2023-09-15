<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    {{-- custum links --}}
    <link rel="stylesheet" href="{{ url('css/style.css') }}">

    <!-- bootstrap links -->
    <link rel="stylesheet" href="{{ url('bootstrap-5.2.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('bootstrap-icons/font/bootstrap-icons.css') }}">
    <script src="{{ url('bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- sidebar cores -->
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
    <script src="{{ url('js/scripts.js') }}"></script>

    {{-- scripts links --}}
</head>

<body class="bg" data-bs-config="smoothScroll">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        @include('components.admin_sidebar')

        <!-- Page content wrapper-->
        <div class="ps-3 pe-3 content-fixed" id="page-content-wrapper">
            <!-- Top navigation-->
            @include('components.admin_topbar')

            <!-- Page content-->
            <div class="container-fluid rounded-4 p-1 text-light">
                {{-- contents to be put --}}
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
