@extends('base')

@section('tab-title', 'Team Details')
@section('content')

    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">
        <h1 class="ps-3 py-4 fw-light">Team Details</h1>


        <section class="container mx-auto">
            <div class="py-2 pb-5 table-responsive">
                <table class="table-bordered bg-white">
                    <thead>
                        <th class="px-3 py-2">{{ $gp->name }}</th>
                        <th class="px-3 py-2">{{ $gp->type }}</th>
                        <th class="px-3 py-2">{{ $gp->semester }}</th>
                        <th class="px-3 py-2">{{ $gp->department->name }}</th>
                    </thead>
                </table>
            </div>
        </section>


        <section class="container mt-4">
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    <table class="table">
                        <thead class="table-primary">
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Student Id</th>
                            <th>Major</th>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($gp->students as $student)
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



        <section class="container mt-4">
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    <table class="table">
                        <thead class="table-primary">
                            <th>#</th>
                            <th>Supervisor</th>
                            <th>Email</th>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($gp->supervisors as $supervisor)
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


        <section class="container mt-4">
            <div class="table-responsive my-4">
                <table class="table">
                    <thead class="table-primary">
                        <th>Project Overview</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td>{{ $gp->idea }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="table-responsive my-4">
                <table class="table">
                    <thead class="table-primary">
                        <th>Project Goals</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td>{{ $gp->goal }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="table-responsive my-4">
                <table class="table">
                    <thead class="table-primary">
                        <th>Project Technologies</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td>{{ $gp->technologies }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

@endsection

