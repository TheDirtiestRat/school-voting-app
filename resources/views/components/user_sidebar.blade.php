<div class="d-flex flex-column flex-shrink-0 p-3 bg-blur rounded-start rounded-5 shadow sidebar-fixed"
    id="sidebar-wrapper" style="width: 260px;">

    <ul class="nav nav-pills gap-2 flex-column mb-auto overflow-x-scroll">
        <li class="nav-item text-center text-dark">
            <img src="{{ asset('storage/images/aclc logo.png') }}" class="img-fill rounded mb-1" alt=""
                width="80">
            <h4>ACLC voting system 2023</h4>
            <hr>
        </li>

        {{-- options users --}}
        <li class="nav-item">
            <a class="btn btn-dark w-100 text-start" href="{{ url('votingCandidates') }}" role="button">
                <i class="bi bi-list"></i>
                Voting Candidates
            </a>
            @if (Request::path() == 'votingCandidates')
                <div class="ps-2 mt-2">
                    <ul class="nav nav-pills flex-column">
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
                            <a href="#SubmitVotes" class="nav-link text-dark hover-effect">
                                <i class="bi bi-check"></i>
                                Submit Vote
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
