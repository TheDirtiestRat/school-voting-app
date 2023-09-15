@extends('pdf.layout')

@section('content')
    <div class="m-4 mt-0">
        <h1 class="text-center display-2">{{ $current_category[0]->title }}</h1>

        {{-- contestant data scores by criteria --}}
        @foreach ($criterias as $criteria)
            @if ($criteria->category == $current_category[0]->id)
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th colspan="{{ 3 + $judges->count() }}">
                                Contestant Scores on {{ $criteria->title }}
                            </th>
                        </tr>
                        <tr>
                            <th>No.</th>
                            <th>Contestant</th>
                            {{-- judges list --}}
                            @foreach ($judges as $judge)
                                <th>{{ $judge->name }}</th>
                            @endforeach
                            <th>total</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- if category is on top 3, then show only the top 3 scored contestants --}}
                        @if ($current_category[0]->title != 'Top 3')
                            {{-- contestants by row --}}
                            @foreach ($contestants as $contestant)
                                <tr>
                                    <td>{{ $contestant->contestant_number }}</td>
                                    <td class="text-start">{{ $contestant->name }}</td>
                                    {{-- scores of judges by column --}}
                                    @foreach ($judges as $judge)
                                        <td>
                                            @foreach ($contestants_scores as $contestant_score)
                                                @if (
                                                    $contestant_score->contestant == $contestant->name &&
                                                        $contestant_score->criteria == $criteria->title &&
                                                        $contestant_score->judge == $judge->name)
                                                    {{ $contestant_score->score }}
                                                @endif
                                            @endforeach
                                        </td>
                                    @endforeach
                                    {{-- total scores --}}
                                    <td>
                                        @foreach ($contestant_totalAvg_scores as $totals)
                                            @if ($totals[1] == $criteria->title && $totals[2] == $contestant->name)
                                                {{-- <strong>{{ $totals[0] }}</strong> --}}
                                                {{ $totals[0] }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            {{-- contestants by row --}}
                            @foreach ($contestants as $contestant)
                                @foreach ($contestant_total_scores as $top_3_con)
                                    @if ($top_3_con->contestant == $contestant->name)
                                        <tr>
                                            <td>{{ $contestant->contestant_number }}</td>
                                            <td class="text-start">{{ $contestant->name }}</td>
                                            {{-- scores of judges by column --}}
                                            @foreach ($judges as $judge)
                                                <td>
                                                    @foreach ($contestants_scores as $contestant_score)
                                                        @if (
                                                            $contestant_score->contestant == $contestant->name &&
                                                                $contestant_score->criteria == $criteria->title &&
                                                                $contestant_score->judge == $judge->name)
                                                            {{ $contestant_score->score }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @endforeach
                                            {{-- total scores --}}
                                            <td>
                                                @foreach ($contestant_totalAvg_scores as $totals)
                                                    @if ($totals[1] == $criteria->title && $totals[2] == $contestant->name)
                                                        {{-- <strong>{{ $totals[0] }}</strong> --}}
                                                        {{ $totals[0] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                        {{-- contestants by row --}}
                        {{-- @foreach ($contestants as $contestant)
                            <tr>
                                <td>{{ $contestant->contestant_number }}</td>
                                <td>{{ $contestant->name }}</td>
                                scores of judges by column
                                @foreach ($judges as $judge)
                                    <td>
                                        @foreach ($contestants_scores as $contestant_score)
                                            @if ($contestant_score->contestant == $contestant->name && $contestant_score->criteria == $criteria->title && $contestant_score->judge == $judge->name)
                                                {{ $contestant_score->score }}
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                                total scores
                                <td>
                                    @foreach ($contestant_totalAvg_scores as $totals)
                                        @if ($totals[1] == $criteria->title && $totals[2] == $contestant->name)
                                            {{ $totals[0] }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            @endif
        @endforeach

    </div>
@endsection
