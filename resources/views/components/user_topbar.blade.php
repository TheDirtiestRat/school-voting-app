<nav class="navbar navbar-expand-lg navbar-light bg-blur rounded-4 rounded-top shadow pt-3 pb-3 mb-3">
    <div class="container-fluid">
        <!-- sidebar button -->
        <button class="btn btn-dark" id="sidebarToggle">
            <i class="bi bi-list-task"></i>
        </button>
        
        <!-- user logout -->
        <button class="navbar-toggler p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            {{-- <span class="navbar-toggler-icon"></span> --}}
            <i class="bi bi-list-task"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto gap-2 mt-2 mt-lg-0">
                <li class="nav-item dropdown justify-content-between">
                    <a href="#" class=" text-decoration-none">
                        <button class="btn rounded-3" type="button">{{ Session::get('session_usn') }} - {{ Session::get('voters_name') }} - {{ Session::get('voters_program') }}</button>
                    </a>
                </li>
                <li class="nav-item dropdown justify-content-between">
                    <form action="{{ route('voterLogout') }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-dark rounded-3" type="submit">
                            Logout
                            <i class="bi bi-power"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
