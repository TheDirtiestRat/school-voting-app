@extends('layouts.center')

@section('content')
    <div class="shadow bg-blur rounded p-3">
        <h1>Add new Candidate</h1>

        <form action="{{ route('Candidates.store') }}" method="post" class="needs-validations" enctype="multipart/form-data"
            novalidate>
            {{-- for validation --}}
            @csrf

            <div class="row ">
                <div class="col-auto">
                    {{-- photo --}}
                    <div class="text-center">
                        <div>
                            <img src="{{ url('storage/images/aclc logo.png') }}" class="img-fill rounded-2" id="outputImage"
                                alt="candidate" width="250" height="250">
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    {{-- info --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Name" class="form-label">Student Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" id="Name"
                                value="" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Program" class="form-label">School Program</label>
                            <select class="form-select" aria-label="Default select example" name="program" id="Program"
                                required>
                                <option selected disabled value>Select a program</option>
                                <option value="BSIT">BSIT</option>
                                <option value="BSCS">BSCS</option>
                                <option value="BSHM">BSHM</option>
                                <option value="STEM">STEM</option>
                                <option value="TVL">TVL</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="Position" class="form-label">Position to run</label>
                            <select class="form-select" aria-label="Default select example" name="position" id="Position"
                                required>
                                <option selected disabled value>Select a position</option>
                                <option value="President">President</option>
                                <option value="Vice President">Vice President</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Treasurer">Treasurer</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="School Level" class="form-label">School Level</label>
                        <select class="form-select" aria-label="Default select example" name="school_level" id="School Level"
                            >
                            <option selected disabled value>Select a School Level</option>
                            <option value="College">College</option>
                            <option value="Senior High">Senior High</option>
                        </select>
                    </div>
                    <div>
                        <label for="file" class="form-label">Photo</label>
                        <input class="form-control" type="file" accept="image/*" name="photo" id="file"
                            onchange="loadFile(event)">
                    </div>
                </div>
            </div>

            <hr>
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

            <div class="d-flex justify-content-between">
                <a class="btn btn-outline-dark" href="{{ route('Candidates.index') }}" role="button">Back</a>
                <div>
                    <button type="submit" class="btn btn-dark">Add</button>
                </div>
            </div>
        </form>
    </div>

    <!-- image display script -->
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('outputImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
