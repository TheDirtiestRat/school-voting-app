@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center">
        {{-- success message when we add new data --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success container-900" role="alert">
                {{-- shows the message given --}}
                <p class="m-0">{{ $message }}</p>
            </div>
        @endif
    </div>

    {{-- show if its college or senior high --}}
    @if ($school_level)
        <h2>{{ $school_level }} Candidates</h2>
    @endif

    {{-- list of candidates --}}
    <div class="row justify-content-center">
        {{-- group by positions --}}
        @foreach ($Positions_list as $position)
            <h1 class="text-center display-1" id="{{ $position }}">{{ $position }}</h1>

            {{-- candidate in this position --}}
            @foreach ($Candidates as $candidate)
                @if ($candidate->position == $position)
                    {{-- candidate card --}}
                    <div class="col-auto">
                        <a href="{{ route('Candidates.edit', $candidate->id) }}" class="btn rounded p-0" role="button">
                            @include('components.candidate_card')
                        </a>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
@endsection
