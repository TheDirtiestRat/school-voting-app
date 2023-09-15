@extends('layouts.center')

@section('content')
    <div class="form-signin w-100 m-auto text-center">
        <form method="POST" action="{{ route('voterLogin') }}">
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
                <input type="number" class="form-control" id="floatingInput" name="usn" placeholder="Enter USN"
                    required>
                <label for="floatingInput">USN ex: 2000XXXX000</label>
            </div>

            {{-- login button --}}
            <button class="w-100 btn btn-dark shadow mt-2" type="submit">
                Log in
            </button>

            <div class="text-light mt-3">
                @include('components.copyright')
            </div>
        </form>
    </div>
@endsection
