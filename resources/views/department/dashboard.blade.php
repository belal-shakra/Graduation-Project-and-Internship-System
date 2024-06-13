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

                <form action="{{ route('department.store', $department) }}" method="post">
                    @csrf
                    <div class="row mt-3 mb-">
                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group me-3 border-a rounded">
                                <label class="input-group-text fw-bold">Start</label>
                                <input type="date" class="form-control" name="start" value="{{ $department->start }}">
                            </div>
                            @error('start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group me-3 border-a rounded">
                                <label class="input-group-text fw-bold">End</label>
                                <input type="date" class="form-control" name="end" value="{{ $department->end }}">
                            </div>
                            @error('end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mb-3 border-a rounded">
                                <span class="input-group-text fw-bold">No. of Team's Members</span>
                                <input type="number" class="form-control" name="no_team_member" min=2 value="{{ $department->no_team_member }}">
                            </div>
                            @error('no_team_member')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-lg-4 mb-1">
                            <div class="input-group mb-3 border-a rounded">
                                <span class="input-group-text fw-bold">Internship Week</span>
                                <input type="number" class="form-control" name="week" value="{{ $department->week }}">
                            </div>
                            @error('week')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <input type="submit" value="Save" class="form-control btn btn-primary">
                        </div>
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
                                    <p class="card-text">
                                        <span class="fs-4">{{ $exceed90 }}</span>/ <small>{{ $all_stus }}</small>
                                    </p>
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
                                    <p class="card-text"><span class="fs-4">{{ $in_gp }}</span>/ <small>{{ $exceed90 }}</small></p>
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
                                    <p class="card-text"><span class="fs-4">{{ $in_int }}</span>/ <small>{{ $exceed90 }}</small></p>
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
                                    <p class="card-text"><span class="fs-4">{{ $expectTG }}</span>/ <small>{{ $all_stus }}</small></p>
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
