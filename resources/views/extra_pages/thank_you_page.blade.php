<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank you</title>

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
        @include('components.system_title')

        <h1 class="display-1">Thank you for voting <strong>{{session('voters_name')}}</strong>. Hope you have a
            great day.</h1>

        <form action="{{ route('voterLogout') }}" method="post">
            @csrf
            @method('DELETE')

            <button class="btn btn-dark rounded-3" type="submit">
                Finish Vote
            </button>
        </form>
    </div>
</body>

</html>
