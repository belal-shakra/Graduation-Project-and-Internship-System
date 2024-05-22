<!-- Aside -->
<aside class="navbar navbar-expand-xl col-xl-2 show" id="aside" style="z-index: 999;">
    <div class="collapse navbar-collapse" id="sidebar" >
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow-lg" style="width: 16rem; position: fixed; top: 83px; bottom: 0%;">
            <span class="fs-4 px-3 text-center">Quick Access</span>
            <hr>
            <ul class="nav flex-column" id="quick-access">
                <li>
                    <a href="{{ route('student.home') }}" class="nav-link link-dark dash-opt rounded">Home</a>
                </li>


                <li class="nav-item collapsed" data-bs-toggle="collapse" data-bs-target="#drop-grad" role="button">
                    <span class="nav-link link-dark dash-opt rounded">
                        Graduation Project
                        <i class="bi bi-caret-down-fill"></i>
                    </span>
                </li>
                <ul class="nav collapse mx-2 mt-1 alert alert-secondary px-0 py-1 show" id="drop-grad">
                    <a class="nav-link link-dark" href="{{ route('student.home') }}"><li class="nav-ite">Register Form</li></a>
                    {{-- <li class="nav-item"><a class="nav-link link-dark" href="{{ route('student.home') }}">Recommended Projects</a></li> --}}
                    <li class="nav-item"><a class="nav-link link-dark" href="">Timeline</a></li>
                </ul>




                <li class="nav-item collapsed" data-bs-toggle="collapse" data-bs-target="#drop-intern" role="button">
                    <span class="nav-link link-dark dash-opt rounded">
                        Internship
                        <i class="bi bi-caret-down-fill"></i>
                    </span>
                </li>
                <ul class="nav collapse mx-2 mt-1 alert alert-secondary px-0 py-1 show" id="drop-intern">
                    <li class="nav-item"><a class="nav-link link-dark" href="{{ route('company.create') }}">Company's Form</a></li>
                    <li class="nav-item"><a class="nav-link link-dark" href="{{ route('course.create') }}">Course's Form</a></li>
                </ul>

            </ul>

            <hr>

            <div class="dropdown ms-2">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle px-2 fs-4"></i>
                    <strong>bla0192452</strong>
                </a>
                <ul class="dropdown-menu text-small shadow">
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <input type="submit" value="Sign out" class="dropdown-item">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
