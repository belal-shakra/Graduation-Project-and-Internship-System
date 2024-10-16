

<!-- Header -->
<header class="mb-5" style="z-index: 999;">
    <nav class="navbar bg-grad-blue fixed-top px-2 ps-3">
        <button class="d-xl-none navbar-toggler fs-1" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
            <i class="bi bi-list text-white"></i>
        </button>

        <div class="w-25" style="position: relative; right: rem;">
            <a class="navbar-brand" >
                <img src="{{ asset('assets') }}/img/all/ju-logo-white.png" alt="Logo" style="width: 12rem;">
            </a>
        </div>

        <div class="pe-xl-5 me-3">
            <ul class="nav pe-xl-" style="position: relative; top: 5px">
                <li class="nav-lin dropstart" role="button">
                    @if ($there_is)
                        <span class=" position-relative" data-bs-toggle="dropdown">
                            <i class="bi bi-bell-fill text-white fs-4"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                            </span>
                        </span>
                    @else
                        <i class="bi bi-bell-fill text-white fs-4" data-bs-toggle="dropdown"></i>
                    @endif

                    <ul class="dropdown-menu mt-5 p-0">
                        @include('parts.notification')
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>
