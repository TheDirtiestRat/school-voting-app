@extends('pdf.layout')

@section('content')
    <div class="m-4 mt-0">
        <h2 class="text-center display-2">Voting Results</h2>

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
                    <td>{{ $total_voters }}</td>
                    <td class="text-end">Voted:</td>
                    <td>{{ $total_votes }} ({{ $percent_votes_total }}%)</td>
                    <td class="text-end">Remaining:</td>
                    <td>{{ $remaining_votes }} ({{ $percent_remaining_votes }}%)</td>
                </tr>
            </tbody>
        </table>

        {{-- candidates score --}}
        <table class="table text-light">
            <thead>
                <tr>
                    <th colspan="4" class="text-center">
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
                        <th colspan="4" class="text-start display-6">
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
                                </td>
                            </tr>
                        @endif
                    @endfor
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
