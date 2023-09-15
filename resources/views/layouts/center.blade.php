<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School Voting System</title>

    {{-- custom styles --}}
    <link rel="stylesheet" href="{{ url('css/style.css') }}">

    {{-- link styles here --}}
    <link rel="stylesheet" href="{{ url('bootstrap-5.2.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('bootstrap-icons/font/bootstrap-icons.css') }}">
    <script src="{{ url('bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js') }}"></script>
</head>

<body class="bg">
    {{-- content --}}
    <div class="p-md-5 p-2 center">
        @yield('content')
    </div>

    <!-- Form validation script -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validations')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>
