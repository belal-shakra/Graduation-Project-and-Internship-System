@extends('base')

@section('tab-title', 'Home')
@section('content')
    <div class="bg-grad-blue border border-2 border-white px-3 mb-5 mx-2 rounded shadow position-relative" style="top: -5px;">
        <div id="" class="fs-5">

            <nav class="navbar navbar-expand-lg d-inline-block px-">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-content">
                    <i class="bi bi-list text-white fs-1"></i>
                </button>

                <div class="collapse navbar-collapse" id="nav-content">
                    <ul class="navbar-nav">

                        <li class="nav-item px-3">
                            <a type="button" class="nav-link text-white" >
                                <i class="bi bi-person-circle"></i>
                                <span class="px-2">{{ Auth::user()->username }}</span>
                            </a>
                        </li>

                        <li class="nav-item px-3" data-bs-toggle="dropdown">
                            <a href="" class="nav-link text-white">
                                {{-- <span class=" position-relative">
                                    <i class="bi bi-bell-fill text-white"></i>
                                    <span class="position-absolute top-25 start-0 translate-middle p-2 bg-danger border border-light rounded-circle">
                                    </span>
                                </span> --}}
                                <i class="bi bi-bell-fill text-white"></i>
                                <span class="px-2">Notification</span>
                            </a>
                        </li>
                        <ul class="dropdown-menu  p-0">
                        </ul>

                        <li class="nav-item px-3">
                            <form action="{{ route('logout') }}" method="post" id="logout">
                                @csrf
                                <a type="button"
                                onclick="document.getElementById('logout').submit();"
                                class="nav-link text-white">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span class="px-2">Logout</span>
                                </a>
                            </form>
                        </li>

                    </ul>
                </div>
            </nav>

        </div>
    </div>


    <main>

        <!-- Alert -->
        <section class="container">
            <div class="container text-center w-75 alert alert-primary">
                <p class="lead fs-3 text-primary">
                {{ $student_username }}, you have successfully completed 90 hours,
                so you can register for the internship and graduation project.
                </p>
            </div>
        </section>




        <!-- Main Buttons -->
        <section class="container py-5">
            <div class="row p-3 d-flex justify-content-center">
                <a href="{{ route('student.company.create') }}"
                type="button" class="col col-lg-4 p-5 m-3 rounded btn btn-outline-primary border-2 border-primary shadow-lg d-flex align-items-center justify-content-center">
                    <p class="display-5 fw-bold">Internship</p>
                </a>

                <a href="{{ route('student.graduation-project.create') }}"
                type="button" class="col col-lg-4 p-5 m-3 rounded btn btn-outline-primary border-2 border-primary shadow-lg d-flex align-items-center justify-content-center">
                    <p class="display-5 fw-bold">Graduation Project</p>
                </a>
            </div>
        </section>
    </main>
@endsection
