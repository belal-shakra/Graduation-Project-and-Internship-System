<!-- Aside -->
<aside class="navbar navbar-expand-xl col-xl-2 col-xxl-1" id="aside" style="z-index: 999;">
  <div class="collapse navbar-collapse" id="sidebar" >
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light shadow-lg" style="width: 16rem; position: fixed; top: 83px; bottom: 0%;">
      <a href="{{ route('department.home') }}" class=" link-dark text-decoration-none text-center">
        <span class="fs-4">Dashboard</span>
      </a>
      <hr>
      
      <ul class="nav flex-column" id="quick-access">
        <li class="nav-item collapsed" data-bs-toggle="collapse" data-bs-target="#drop-grad" role="button">
          <span class="nav-link link-dark dash-opt rounded">
            Graduation Project
            <i class="bi bi-caret-down-fill"></i>
          </span>
        </li>
        <ul class="nav collapse show mx-2 mb-1 px-0 py-1 bg-secondary-subtle rounded" id="drop-grad">
          <li class="nav-item"><a class="nav-link link-dark" href="{{ route('department.exceed90') }}">Students that Exceed 90 Hours</a></li>
          <li class="nav-item"><a class="nav-link link-dark" href="{{ route('department.teams') }}">Graduation Projects Teams</a></li>
        </ul>




        <li class="nav-item collapsed" data-bs-toggle="collapse" data-bs-target="#drop-intern" role="button">
          <span class="nav-link link-dark dash-opt rounded">
            Internship
            <i class="bi bi-caret-down-fill"></i>
          </span>
        </li>
        <ul class="nav collapse show mx-2 mb-1 px-0 py-1 bg-secondary-subtle rounded" id="drop-intern">
          <li class="nav-item"><a class="nav-link link-dark" href="{{ route('department.in_int') }}">Internship Students</a></li>
        </ul>

      </ul>




      <hr>
      <div class="dropdown ms-2">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
          <i class="bi bi-diagram-3-fill pe-3 fs-4"></i>
          <strong class="text-truncate">{{ Auth::user()->department->name }}</strong>
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