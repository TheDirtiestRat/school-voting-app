@extends('pdf.layout')

@section('content')
    <div class="m-4 mt-0">
        <h2 class="text-center display-2">List of Voters</h2>

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
                    <td>Voters:</td>
                    <td>{{ $total_voters }}</td>
                    <td>Voted:</td>
                    <td>{{ $total_votes }} ({{ $percent_votes_total }}%)</td>
                    <td>Remaining:</td>
                    <td>{{ $remaining_votes }} ({{ $percent_remaining_votes }}%)</td>
                </tr>
            </tbody>
        </table>

        {{-- prorams list --}}
        <table class="table text-light">
            <thead>
                <tr>
                    <th colspan="{{ count($total_by_program) * 2 }}" class="text-center">
                        Programs
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- how many by program --}}
                <tr>
                    @foreach ($total_by_program as $program)
                        <td>{{ $program->program }}:</td>
                        <td>{{ $program->total }}</td>
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
                        <td>{{ $voter->year }}</td>
                        <td class="">{{ $voter->school_level }}</td>
                        <td>
                            {{ $voter->isVoted }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
