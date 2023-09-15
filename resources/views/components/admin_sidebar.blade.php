<div class="d-flex flex-column flex-shrink-0 p-3 bg-blur rounded-start rounded-5 shadow sidebar-fixed"
    id="sidebar-wrapper" style="width: 260px;">

    <ul class="nav nav-pills gap-2 flex-column mb-auto overflow-x-scroll">
        <li class="nav-item text-center text-dark">
            <img src="{{ asset('storage/images/aclc logo.png') }}" class="img-fill rounded mb-1" alt=""
                width="80">
            <h4>ACLC voting system 2023</h4>
            <hr>
        </li>

        {{-- option list admin --}}
        <li class="nav-item">
            <a class="btn btn-dark w-100 text-start" href="{{ url('/Admin/Dashboard') }}" role="button">
                <i class="bi bi-speedometer"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="btn btn-dark w-100 text-start" href="{{ route('Candidates.index') }}" role="button">
                <i class="bi bi-person-circle"></i>
                Candidates
            </a>
            @if (Request::path() == 'Admin/Candidates')
                <div class="ps-2 mt-2">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="{{ route('Candidates.create') }}" class="nav-link text-dark hover-effect">
                                <i class="bi bi-plus-circle"></i>
                                Add Candidates
                            </a>
                        </li>
                        <hr class="m-1">
                        @foreach ($Positions_list as $position)
                            <li class="nav-item">
                                <a href="#{{ $position }}" class="nav-link text-dark scroll-target hover-effect">
                                    <i class="bi bi-person"></i>
                                    {{ $position }}
                                </a>
                            </li>
                        @endforeach
                        <hr class="m-1">
                        <li class="nav-item">
                            <a href="{{ route('Candidates.index') }}?school_level=College" class="nav-link text-dark hover-effect">
                                <i class="bi bi-list-nested"></i>
                                College
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Candidates.index') }}?school_level=Senior High" class="nav-link text-dark hover-effect">
                                <i class="bi bi-list-nested"></i>
                                Senior High
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </li>
        <li class="nav-item">
            <a class="btn btn-dark w-100 text-start" href="{{ route('Voters.index') }}" role="button">
                <i class="bi bi-person"></i>
                Voters
            </a>
            @if (Request::path() == 'Admin/Voters')
                <div class="ps-2 mt-2">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="{{ route('Voters.create') }}" class="nav-link text-dark hover-effect">
                                <i class="bi bi-plus-circle"></i>
                                Register a Voter
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </li>
        <li class="nav-item">
            <a class="btn btn-dark w-100 text-start" href="{{ route('results') }}" role="button">
                <i class="bi bi-list"></i>
                Votes Results
            </a>
            @if (Request::path() == 'Admin/votingResults')
                <div class="ps-2 mt-2">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="{{ route('results_pdf') }}" class="nav-link text-dark hover-effect">
                                <i class="bi bi-printer"></i>
                                Print to pdf
                            </a>
                        </li>
                        <hr class="m-1">
                        <li class="nav-item">
                            <a href="{{ route('results') }}?school_level=College" class="nav-link text-dark hover-effect">
                                <i class="bi bi-list-nested"></i>
                                College
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('results') }}?school_level=Senior High" class="nav-link text-dark hover-effect">
                                <i class="bi bi-list-nested"></i>
                                Senior High
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </li>
    </ul>

    <hr>
    <div>
        @include('components.copyright')
    </div>
</div>
