<header class="tt-top-fixed bg-light-subtle">
    <div class="container-fluid">
        <nav class="navbar navbar-top navbar-expand" id="navbarDefault">
            <div class="collapse navbar-collapse justify-content-between">

                {{-- Mobile Toggle + Logo --}}
                <div class="tt-mobile-toggle-brand d-lg-none d-md-none">
                    <a class="tt-toggle-sidebar pe-3" href="#offcanvasLeft" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                        <i data-feather="menu"></i>
                    </a>
                    <div class="tt-brand pe-3">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/logo-icon.png') }}" class="tt-brand-favicon" alt="favicon" />
                        </a>
                    </div>
                </div>

                {{-- Right Side Navbar --}}
                <ul class="navbar-nav ms-auto flex-row align-items-center tt-top-navbar">
                    <li class="nav-item dropdown tt-user-dropdown">
                        <a class="nav-link lh-1 pe-0 d-flex align-items-center" id="navbarDropdownUser" href="#!"
                           role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="true">

                            {{-- User Info --}}
                            <div class="text-end me-2">
                                <div class="fw-semibold">{{ auth()->user()->name ?? ''}}</div>
                            </div>

                            {{-- Avatar --}}
                            <div class="avatar avatar-sm status-online">
                                @php 
                                    $path = 'assets/img/Tonmoy_logo.jpg';
                                    if (!empty(auth()->user()->image)) {
                                        $path = 'img/users/' . auth()->user()->image;
                                    }
                                @endphp
                                <img class="rounded-circle" src="{{ asset($path) }}" alt="avatar">
                            </div>
                        </a>

                        {{-- Dropdown --}}
                        <div class="dropdown-menu dropdown-menu-end py-0 shadow border-0" aria-labelledby="navbarDropdownUser">
                            <div class="card position-relative border-0">
                                <div class="card-body py-2">
                                    <ul class="tt-user-nav list-unstyled d-flex flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link px-0 py-1" href="#">
                                                <i data-feather="user" class="me-1 fs-sm"></i>Profile
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link px-0 py-1" href="{{ route('logout') }}">
                                                <i data-feather="log-out" class="me-1 fs-sm"></i>Sign out
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
