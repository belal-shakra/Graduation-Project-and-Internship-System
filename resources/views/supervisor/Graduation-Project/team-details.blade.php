@extends('base')

@section('tab-title', 'Team Details')
@section('content')


    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">
        <h1 class="ps-3 py-4 fw-light">Team Details</h1>


        <section class="container mx-auto">
            <div class="py-2 pb-5 table-responsive">
                <table class="table-bordered bg-white">
                    <thead>
                        <th class="px-3 py-2">{{ $project->name }}</th>
                        <th class="px-3 py-2">{{ $project->type }}</th>
                        <th class="px-3 py-2">{{ $project->semester }}</th>
                        <th class="px-3 py-2">{{ $project->department->name }}</th>
                    </thead>
                </table>
            </div>
        </section>



        <nav class="container">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link" id="nav-project-details-tab" data-bs-toggle="tab" data-bs-target="#nav-project-details"
                type="button">Project Details</button>

                <button class="nav-link active" id="nav-timeline-tab" data-bs-toggle="tab" data-bs-target="#nav-timeline"
                type="button">Timeline</button>
            </div>
        </nav>

        <div class="tab-content container" id="nav-tabContent">
            <div class="tab-pane fade" id="nav-project-details" role="tabpanel">

                <section class="mt-4">
                    <div class="row">
                        <div class="col-sm-12 col-lg-8">
                            <table class="table table-striped">
                                <thead class="table-primary">
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Student Id</th>
                                    <th>Major</th>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($project->students as $student)
                                        <tr>
                                            <th style="width: 0%;">1</th>
                                            <td>{{ $student->user->first_name }} {{ $student->user->last_name }}</td>
                                            <td>{{ $student->user->university_id }}</td>
                                            <td>{{ $student->user->department->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
        
        
        
                <section class="mt-4">
                    <div class="row">
                        <div class="col-sm-12 col-lg-8">
                            <table class="table table-striped">
                                <thead class="table-primary">
                                    <th>#</th>
                                    <th>Supervisor</th>
                                    <th>Email</th>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($project->supervisors as $supervisor)
                                        <tr>
                                            <th style="width: 0%;">{{ $loop->iteration }}</th>
                                            <td>{{ $supervisor->user->first_name }} {{ $supervisor->user->last_name }}</td>
                                            <td>{{ $supervisor->user->email }}</td>
                                        </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
        
        
                <section class="mt-4">
                    <div class="table-responsive my-1">
                        <table class="table">
                            <thead class="table-primary">
                                <th>Project Overview</th>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>{{ $project->idea }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
        
        
                    <div class="table-responsive my-1">
                        <table class="table">
                            <thead class="table-primary">
                                <th>Project Goals</th>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>{{ $project->goal }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
        
        
                    <div class="table-responsive my-1">
                        <table class="table">
                            <thead class="table-primary">
                                <th>Project Technologies</th>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>{{ $project->technologies }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>


            <div class="tab-pane fade show active" id="nav-timeline" role="tabpanel">
                @include('student.Graduation-Project.Timeline.create-post')
                @include('student.Graduation-Project.Timeline.posts')
            </div>
        </div>


    </main>

@endsection
