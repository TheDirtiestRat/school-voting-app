@extends('pdf.layout')

@section('content')
    <h1 class="text-center display-1">{{ $category->title }} Scores</h1>
    {{-- table --}}
    {{-- by criteria --}}
    @foreach ($by_criteria as $criteria)
        @if ($criteria->category == $category->id)
            <div class="m-4">
                <h1>{{ $criteria->title }}</h1>

                <div class="m-4">
                    {{-- separate by gender --}}
                    <h3>Male</h3>
                    {{-- table scores --}}
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Candidate</th>
                                @foreach ($judges_list as $judge)
                                    <th scope="col">{{ $judge->name }}</th>
                                @endforeach

                            </tr>
                        </thead>
                        <tbody>
                            {{-- by contestants --}}
                            @foreach ($contestant_list as $contestant)
                                @if ($contestant->gender == 'Male')
                                    <tr>
                                        <td scope="row">{{ $contestant->name }}</td>
                                        {{-- scores by judges --}}
                                        @foreach ($judges_list as $judge)
                                            {{-- match the score by judge and contestant --}}
                                            <td>
                                                @foreach ($scores as $score)
                                                    @if (
                                                        $score->contestant == $contestant->id &&
                                                            $contestant->gender == 'Male' &&
                                                            $score->judge == $judge->id &&
                                                            $score->criteria == $criteria->id)
                                                        {{ $score->score }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>

                    <h3>Female</h3>
                    {{-- table scores --}}
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Candidate</th>
                                @foreach ($judges_list as $judge)
                                    <th scope="col">{{ $judge->name }}</th>
                                @endforeach

                            </tr>
                        </thead>
                        <tbody>
                            {{-- by contestants --}}
                            @foreach ($contestant_list as $contestant)
                                @if ($contestant->gender == 'Female')
                                    <tr>
                                        <td scope="row">{{ $contestant->name }}</td>
                                        {{-- scores by judges --}}
                                        @foreach ($judges_list as $judge)
                                            {{-- match the score by judge and contestant --}}
                                            <td>
                                                @foreach ($scores as $score)
                                                    @if (
                                                        $score->contestant == $contestant->id &&
                                                            $contestant->gender == 'Female' &&
                                                            $score->judge == $judge->id &&
                                                            $score->criteria == $criteria->id)
                                                        {{ $score->score }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endforeach
@endsection
