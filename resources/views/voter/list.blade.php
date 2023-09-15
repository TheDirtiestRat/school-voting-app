@extends('layouts.admin')

@section('content')
    <div class="p-4">
        {{-- topbar options --}}
        <form action="{{ route('voter-index') }}" method="get">
            <div class="bg-blur rounded-4 p-3 h-100 justify-content-between">
                {{-- search field --}}
                <div class="row g-2">
                    <div class="col">
                        {{-- By department --}}
                        <select class="form-select" aria-label="Default select example" name="school_level" id="school_level">
                            <option selected disabled value>Get by Department</option>
                            <option value="College">College</option>
                            <option value="Senior High">Senior High</option>
                        </select>
                    </div>
                    <div class="col">
                        {{-- By program --}}
                        <select class="form-select" aria-label="Default select example" name="program" id="program">
                            <option selected disabled value>Get by Program</option>
                            @foreach ($total_by_program as $program)
                                <option value="{{ $program->program }}">{{ $program->program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        {{-- By year --}}
                        <select class="form-select" aria-label="Default select example" name="year" id="year">
                            <option selected disabled value>Get by Year</option>
                            @foreach ($total_by_year as $year)
                                <option value="{{ $year->year }}">{{ $year->year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-auto d-flex align-items-center">
                        <div class="row">
                            <div class="col-auto">
                                {{-- is voted or not --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="isVoted" id="flexRadioDefault1"
                                        value="not yet">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Not Voted
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="isVoted" id="flexRadioDefault2"
                                        value="voted">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Voted
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-dark" type="submit">
                            Search
                        </button>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-dark rounded-3" href="" role="button" target="_blank" id="print_pdf_btn"
                            onclick="get_form_search_value()">Print PDF</a>
                    </div>
                </div>
            </div>
        </form>

        <div class=" overflow-scroll">
            {{-- totals overall --}}
            <table class="table text-light">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center">
                            <h2>Totals</h2>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-end">Voters:</td>
                        <td class="text-start">{{ $total_voters }}</td>
                        <td class="text-end">Voted:</td>
                        <td class="text-start">{{ $total_votes }} ({{ $percent_votes_total }}%)</td>
                        <td class="text-end">Remaining:</td>
                        <td class="text-start">{{ $remaining_votes }} ({{ $percent_remaining_votes }}%)</td>
                    </tr>
                </tbody>
            </table>

            {{-- prorams list --}}
            <table class="table text-light">
                <thead>
                    <tr>
                        <th colspan="{{ count($total_by_program) * 2 }}" class="text-center">
                            <h3>Programs</h3>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- how many by program --}}
                    <tr>
                        @foreach ($total_by_program as $program)
                            <td class="text-end">{{ $program->program }}:</td>
                            <td class="text-start">{{ $program->total }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>

            {{-- voters list --}}
            <table class="table text-light">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center">
                            <h2>Voters</h2>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center">USN</th>
                        <th>Name</th>
                        <th>Program</th>
                        <th>Year</th>
                        <th>School Level</th>
                        <th>Voted</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Voters as $voter)
                        <tr>
                            <td class="text-center">{{ $voter->USN }}</td>
                            <td class="text-start">{{ $voter->name }}</td>
                            <td>{{ $voter->program }}</td>
                            <td class="text-start">{{ $voter->year }}</td>
                            <td class="text-start">{{ $voter->school_level }}</td>
                            <td class="text-start">
                                @if ($voter->isVoted == 'voted')
                                    <span class="text-light">Voted</span>
                                @else
                                    <span class="text-muted">Not Voted</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- pagination --}}
            {{ $Voters->links('vendor.pagination.bootstrap-5') }}
        </div>

        {{-- get the form data to be passed in the pdf creation --}}
        <script>
            function get_form_search_value() {
                var is_voted = document.getElementsByName("isVoted");
                var year = document.getElementById("year");
                var school_level = document.getElementById("school_level");
                print_pdf_btn = document.getElementById("print_pdf_btn");

                program = document.querySelector('#program');

                var get_link = "?isVoted=";

                is_voted.forEach(voted => {
                    if (voted.checked) {
                        get_link = "?isVoted=" + voted.value;
                    }
                });

                get_link += "&program=" + program.value
                get_link += "&year=" + year.value
                get_link += "&school_level=" + school_level.value

                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);

                if (urlParams.has('isVoted') || urlParams.has('program') || urlParams.has('year') || urlParams.has('school_level')) {
                    program = urlParams.get('program')
                    // console.log(program);
                    isVoted = urlParams.get('isVoted')
                    // console.log(isVoted);
                    year = urlParams.get('year')
                    school_level = urlParams.get('school_level')
                    // console.log(year);

                    get_link = "?isVoted=" + isVoted + "&program=" + program + "&year=" + year + "&school_level=" + school_level
                }

                print_pdf_btn.href = "{{ route('voters_pdf') }}" + get_link;
                // console.log(print_pdf_btn.href);
            }
        </script>
    </div>
@endsection
