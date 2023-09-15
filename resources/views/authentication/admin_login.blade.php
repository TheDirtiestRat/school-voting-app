@extends('layouts.center')

@section('content')
    <div class="form-signin w-100 m-auto text-center">
        <form method="POST" action="{{ route('adminLogin') }}">
            @csrf
            {{-- title --}}
            <div class="text-light">
                @include('components.system_title')
            </div>

            {{-- success message when we add new data --}}
            @if ($message = Session::get('success'))
                <div class="alert alert-success container-900" role="alert">
                    {{-- shows the message given --}}
                    <p class="m-0">{{ $message }}</p>
                </div>
            @endif

            {{-- display error --}}
            @if (Session::has('error'))
                <div class="alert alert-danger text-start shadow" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif

            <div class="form-floating shadow mb-2">
                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Username"
                    required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating shadow mb-2">
                <input type="password" class="form-control" id="floatingPass" name="password" placeholder="Password"
                    required>
                <label for="floatingPass">Password</label>
            </div>

            {{-- login button --}}
            {{-- <a href="{{ url('Dashboard') }}"> --}}
            <button class="w-100 btn btn-dark shadow mt-2" type="submit">
                Log in
            </button>
            {{-- </a> --}}

            <div class="text-light mt-3">
                @include('components.copyright')
            </div>
        </form>
    </div>
@endsection
