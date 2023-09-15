@extends('layouts.admin')

@section('content')
    <div class="p-4 text-dark">

        <div class="row gap-3">
            <div class="col">
                <div class="bg-blur rounded-4 p-3 h-100">
                    <h4>Total Voters</h4>
                    <div class="d-flex justify-content-center">
                        <h1 class="display-1 text-center">
                            {{ $total_voters }}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="bg-blur rounded-4 p-3 h-100">
                    <h1>Total Votes</h1>
                    <div class="d-flex justify-content-center">
                        <h1 class="display-1 text-center">
                            {{ $total_votes }}
                        </h1>
                        <span class="display-6">({{ $percent_votes_total }}%)</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="bg-blur rounded-4 p-3 h-100">
                    <h1>Remaining Votes</h1>
                    <div class="d-flex justify-content-center">
                        <h1 class="display-1 text-center">
                            {{ $remaining_votes }}
                        </h1>
                        <span class="display-6">({{ $percent_remaining_votes }}%)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="bg-blur rounded-4 p-3 h-100">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center">
                                    <h2>Leading</h2>
                                </th>
                            </tr>
                            <tr>
                                <th>Candidate</th>
                                <th>Position</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- leading scores for each position --}}
                            @foreach ($votes_by_candidate as $candidate)
                                <tr>
                                    <td class="text-start">{{ $candidate->candidate_name }}</td>
                                    <td class="text-start">{{ $candidate->position }}</td>
                                    <td class="text-start">{{ $candidate->votes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col">
                <div class="bg-blur rounded-4 p-3 h-100">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center">
                                    <h2>Voters By Program</h2>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-end w-50">Program</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- leading scores for each position --}}
                            {{-- how many by program --}}
                            @foreach ($total_by_program as $program)
                                <tr>
                                    <td class="text-end">{{ $program->program }}</td>
                                    <td class="text-start">{{ $program->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
