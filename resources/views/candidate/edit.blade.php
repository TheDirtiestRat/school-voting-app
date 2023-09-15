@extends('layouts.center')

@section('content')
    <div class="shadow bg-blur rounded p-3">
        <h2>Candidate</h2>

        <form action="{{ route('Candidates.update', $candidate->id) }}" method="post" enctype="multipart/form-data">
            {{-- for validation --}}
            @csrf
            @method('PUT')

            <div class="row ">
                <div class="col-auto">
                    {{-- photo --}}
                    <div class="text-center">
                        <div>
                            <img src="{{ url('storage/images/'. $candidate->photo) }}" class="img-fill rounded-2"
                                id="outputImage" alt="candidate" width="250" height="250">
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    {{-- info --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Name" class="form-label">Student Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" id="Name"
                                value="{{ $candidate->name }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Program" class="form-label">School Program</label>
                            <select class="form-select" aria-label="Default select example" name="program" id="Program">
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
                            <select class="form-select" aria-label="Default select example" name="position" id="Position">
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
                            required>
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
            {{-- show error if input is incorrect --}}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-flex justify-content-between">
                <a class="btn btn-outline-dark" href="{{ route('Candidates.index') }}" role="button">Back</a>
                <div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#Modal">Delete</button>
                    <button type="submit" class="btn btn-dark">Update</button>
                </div>
            </div>
        </form>
    </div>

    {{-- delete modal --}}
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Candidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you wanna delete <strong>Test</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    {{-- data deletion form --}}
                    <form action="{{ route('Candidates.destroy', $candidate->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- select script --}}
    <script>
        document.querySelector('#Program').value = '{{ $candidate->program }}'
        document.querySelector('#Position').value = '{{ $candidate->position }}'
        document.querySelector('#School Level').value = '{{ $candidate->school_level }}'
    </script>

    <!-- image display script -->
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('outputImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
