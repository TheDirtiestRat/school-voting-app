@extends('layouts.center')

@section('content')
    <div class="form-container-400">
        <div class="bg-blur shadow rounded p-3">
            <h2>Register new Voter</h2>

            <form action="{{ route('Voters.store') }}" method="post" class="needs-validations" novalidate>
                @csrf
                {{-- alert --}}
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif

                {{-- alert error --}}
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{-- the errors --}}
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-8 mb-3 mb-md-0">
                        <!-- usn -->
                        <label class="form-label" for="USN">USN</label>
                        <input type="number" class="form-control" id="USN" name="USN" placeholder="USN" required>
                    </div>
                    <div class="col-md-4">
                        {{-- year --}}
                        <label class="form-label" for="Usertype">Year</label>
                        <select class="form-select" id="Usertype" name="year" required>
                            <option selected value disabled>select</option>
                            <option value="2023">2023</option>
                            <option value="2023">2022</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <!-- name -->
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="mb-3">
                    {{-- program --}}
                    <label class="form-label" for="Program">Program</label>
                    <select class="form-select" id="Program" name="program" required>
                        <option selected value disabled>select</option>
                        <option value="BSIT">BSIT</option>
                        <option value="BSCS">BSCS</option>
                    </select>
                </div>

                <hr>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-outline-dark" href="{{ route('Voters.index') }}" role="button">Back</a>
                    <button class="btn btn-dark" type="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
