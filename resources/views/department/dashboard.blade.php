@extends('base')

@section('tab-title', 'Dashboard')
@section('content')

    <main class="container-fluid py-5 px- mt-5 col-lg-12 col-xl-8">
        <h1 class="ps-3 py-4 fw-light">Dashboard</h1>

        <section class="container py-1">
            <div class="py-2">
                <p class="lead">
                Starting and ending date to get request for internship and graduation project.
                </p>

                <form action="{% url 'dashboard'%}" method="post">
                    <div class="row mt-3 mb-">
                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group me-3 border-a rounded">
                                <label class="input-group-text fw-bold">Start</label>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group me-3 border-a rounded">
                                <label class="input-group-text fw-bold">End</label>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mb-3 border-a rounded">
                                <span class="input-group-text fw-bold">No. of Team's Members</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-lg-4 mb-1">
                            <div class="input-group mb-3 border-a rounded">
                                <span class="input-group-text fw-bold">Internship Week</span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <input type="submit" value="Save" class="form-control btn btn-primary">
                        </div>
                        <span class="text-danger">vaildation_error</span>
                    </div>
                </form>
            </div>
        </section>


        <section class="container py-1">
            <h2 class="pb-2 fw-light">Computer Science Students Statistics</h2>

            <div class="row py-3">
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                    <div class="ps-2 bg-danger rounded">
                        <div class="card shadow border borderr-1 border-danger">
                            <div class="card-body row">
                                <div class="col-10 col-lg-9 col-xl-10">
                                    <h5 class="card-title small lead fw-bold">Exceed 90 Hours</h5>
                                    <p class="card-text"><span class="fs-4">90</span>/ <small>500</small></p>
                                </div>
                                <div class="col-2 col-lg-3 col-xl-2">
                                    <i class="bi bi-people-fill fs-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                    <div class="ps-2 bg-success rounded">
                        <div class="card shadow border borderr-1 border-success">
                            <div class="card-body row">
                                <div class="col-10">
                                    <h5 class="card-title small lead fw-bold">In Graduation Project</h5>
                                    <p class="card-text"><span class="fs-4">22</span>/ <small>90</small></p>
                                </div>
                                <div class="col-2">
                                    <i class="bi bi-kanban-fill fs-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                    <div class="ps-2 bg-primary rounded">
                        <div class="card shadow border borderr-1 border-primary">
                            <div class="card-body row">
                                <div class="col-10">
                                    <h5 class="card-title small lead fw-bold">In Internship</h5>
                                    <p class="card-text"><span class="fs-4">33</span>/ <small>90</small></p>
                                </div>
                                <div class="col-2">
                                    <i class="bi bi-person-workspace fs-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4">
                    <div class="ps-2 bg-info rounded">
                        <div class="card shadow border borderr-1 border-info">
                            <div class="card-body row">
                                <div class="col-10">
                                    <h5 class="card-title small lead fw-bold">Expected to Graduate</h5>
                                    <p class="card-text"><span class="fs-4">100</span>/ <small>500</small></p>
                                </div>
                                <div class="col-2">
                                    <i class="bi bi-mortarboard-fill fs-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection
