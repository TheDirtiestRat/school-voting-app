@extends('layouts.user')

@section('content')
    <div class="d-flex justify-content-center">
        {{-- display error --}}
        @if (Session::has('error'))
            <div class="alert alert-danger rounded-4 text-start shadow" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
    </div>

    <form action="{{ route('submitVotes') }}" id="votingForm" class="needs-validations" method="post" novalidate>
        {{-- for validation --}}
        @csrf

        {{-- the voter usn --}}
        <input type="number" class="d-none" name="voter_usn" value="{{ Session::get('session_usn') }}">
        {{-- the school level of the candidates --}}
        <input type="text" class="d-none" name="school_level" value="{{ $voter->school_level }}">

        {{-- notify --}}
        <h3 class="m-0 text-center">
            Vote for your choosen {{ $voter->school_level }} Candidates
        </h3>
        {{-- list of candidates --}}
        <div class="row justify-content-center">
            {{-- group by positions --}}
            @foreach ($Positions_list as $position)
                <h1 class="text-center display-1" id="{{ $position }}">{{ $position }}</h1>

                {{-- candidate in this position --}}
                @foreach ($Candidates as $candidate)
                    @if ($candidate->position == $position)
                        {{-- candidate card --}}
                        <div class="col-auto p-0">
                            <label class="form-check-label text-center" for="{{ $position }}{{ $candidate->id }}">
                                @include('components.candidate_card')
                                {{-- radio --}}
                                <input type="radio" class="form-check-input radio" name="{{ $position }}"
                                    id="{{ $position }}{{ $candidate->id }}" value="{{ $candidate->name }}" required>
                            </label>
                        </div>
                    @endif
                @endforeach
            @endforeach

        </div>

        {{-- submit button --}}
        <div class="text-center p-3">
            <button type="submit" class="d-none" id="submitVotesFormBtn" data-bs-toggle="modal"
                data-bs-target="#Modal">Submit vote</button>
        </div>
    </form>

    {{-- submit button --}}
    <div class="text-center p-3">
        <hr>
        <button type="button" class="btn btn-dark btn-lg" id="SubmitVotes" data-bs-toggle="modal"
            data-bs-target="#Modal">Submit vote</button>
    </div>

    {{-- modal --}}
    <div class="modal fade" tabindex="-1" id="Modal">
        <div class="modal-dialog modal-dialog-centered text-dark">
            {{-- modal summary content --}}
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Voting Summary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <th class="text-end w-50">Voted Candidate</th>
                                <th class="text-center"> Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Positions_list as $position)
                                <tr>
                                    <td class="text-end candidateName" id="{{ $position }}">None Selected
                                    </td>
                                    <td class="text-center">{{ $position }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <p class="text-center">
                        Are you sure <strong>about this</strong> votes?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark" onclick="submit_votes()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // submits the form votes
        function submit_votes() {
            document.getElementById("submitVotesFormBtn").click();
        }
    </script>

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

    {{-- gets the summary of candidates voted --}}
    <script>
        const myModalEl = document.getElementById('Modal')
        myModalEl.addEventListener('show.bs.modal', event => {
            // alert("Hi hi")

            var show_voted_candidate = document.getElementsByClassName('candidateName');
            var selected_candidates = document.getElementsByClassName('radio');

            for (let x = 0; x < selected_candidates.length; x++) {
                for (let index = 0; index < show_voted_candidate.length; index++) {
                    if (selected_candidates[x].checked && show_voted_candidate[index].id == selected_candidates[x]
                        .name) {
                        show_voted_candidate[index].innerHTML = "<strong>" + selected_candidates[x].value +
                            "</strong>";
                    }
                }
            }


            // console.log(selected_candidates);
        })
    </script>
@endsection
