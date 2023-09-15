@extends('layouts.admin')

@section('content')
    <div class="p-4">
        {{-- topbar options --}}
        <div>
            <div class="bg-blur rounded-4 p-3 h-100 d-flex justify-content-between">
                <h2 class="m-0 text-dark">
                    @if ($school_level)
                        {{ $school_level }}
                    @endif
                </h2>
                {{-- <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Get Results by
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">College</a></li>
                        <li><a class="dropdown-item" href="#">Senior High</a></li>
                    </ul>
                </div> --}}

                <form action="{{ route('results_pdf') }}" method="get" target="_blank">
                    <input type="text" class="d-none" name="school_level" value="{{ $school_level }}">

                    <button class="btn btn-dark" type="submit">
                        Print PDF
                    </button>
                </form>
                {{-- <a class="btn btn-dark rounded-3" href="{{ route('results_pdf') }}" role="button" target="_blank">Print
                    PDF</a> --}}
            </div>
        </div>

        <div class="overflow-scroll">
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

            {{-- candidates score --}}
            <table class="table text-light">
                <thead>
                    <tr>
                        <th colspan="5" class="text-center">
                            <h2>
                                @if ($school_level)
                                    {{ $school_level }}
                                @endif
                                Candidates
                            </h2>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Name</th>
                        <th>Program</th>
                        <th class="text-center">Votes</th>
                        <th class="text-center">%</th>
                    </tr>
                    {{-- list by position --}}
                    @foreach ($Positions_list as $position)
                        <tr>
                            <th colspan="5" class="text-start display-6">
                                {{ $position }}
                            </th>
                        </tr>
                        {{-- candidate list --}}
                        @for ($i = 0; $i < $Candidates->count(); $i++)
                            @if ($Candidates[$i]->position == $position)
                                <tr>
                                    <td class=" ps-5">{{ $Candidates[$i]->name }}</td>
                                    <td>{{ $Candidates[$i]->program }}</td>
                                    <td class="text-center">
                                        @foreach ($votes_scores as $score_votes)
                                            @if ($score_votes->candidate_name == $Candidates[$i]->name)
                                                {{ $score_votes->scores }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @for ($j = 0; $j < count($votes_percentage); $j++)
                                            @if ($votes_percentage[$j]['candidate'] == $Candidates[$i]->name)
                                                {{ $votes_percentage[$j]['percent'] }}%
                                            @endif
                                        @endfor
                                        {{-- {{ $votes_percentage[$i] }}% --}}
                                    </td>
                                </tr>
                            @endif
                        @endfor
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
