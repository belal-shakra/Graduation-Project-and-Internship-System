@extends('base')

@section('tab-title', 'Internship Report')
@section('content')

    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">
        <div class="ps-3 py-4">
            <h1 class="fw-light">Internship Report</h1>
            <p class="lead ps-2"></p>
        </div>



        <section class="container mx-auto">
            <div class="table-responsive py-2 mb-5">
                <table class="table-bordered bg-white">
                <thead>
                    <th class="px-3 py-2">{{ $student->user->first_name }} {{ $student->user->last_name }}</th>
                    <th class="px-3 py-2">{{ $student->user->university_id }}</th>
                    <th class="px-3 py-2">{{ $student->user->email }}</th>
                    <th class="px-3 py-2">
                        {{ $student->supervisor->user->first_name }} {{ $student->supervisor->user->last_name }}
                    </th>
                </thead>
                </table>
            </div>
        </section>



        @if (count($student->internship_courses))
            <section class="container mx-auto py-3">
                <h2 class="fw-light">Courses</h2>
                <div class="py-2 table-responsive">
                    <table class="table table-bordered border-dark">
                        <thead class="table-primary">
                            <th class="px-3 py-2">Course</th>
                            <th class="px-3 py-2">Hour</th>
                            <th class="px-3 py-2">Provider</th>
                            <th class="px-3 py-2">Certificate</th>
                        <th class="px-3 py-2" style="width: 0%;">Note</th>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($student->internship_courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->hour }}</td>
                                    <td>{{ $course->provider }}</td>
                                    <td class="p-2" style="width: 30rem;">
                                        <a href="" class="d-inline-block text-truncate" style="max-width: 30rem;">course certificate</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#note{{ $loop->iteration }}">
                                            Click
                                        </button>
                                    </td>
                                </tr>


                                <!-- Supervisor Note -->
                                <div class="modal fade" id="notenote{{ $loop->iteration }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">'course name' Note</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h3>Accepted</h3>
                                                    <h3>Rejected</h3>
                                                <div class="py-3 px-2">supervisor note</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        @endif





        @if ($student->internship_company)
            <section class="container mx-auto py-3">
                <div>
                    <h2 class="fw-light">Company</h2>
                    <div class="py-2 table-responsive">
                        <table class="table table-bordered border-dark">
                            <thead class="table-primary">
                                <th class="px-3 py-2">Company</th>
                                <th class="px-3 py-2">Address</th>
                                <th class="px-3 py-2">Start</th>
                                <th class="px-3 py-2">End</th>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>{{ $student->internship_company->company_name }}</td>
                                    <td>{{ $student->internship_company->address }}</td>
                                    <td>{{ $student->internship_company->starting_date }}</td>
                                    <td>{{ $student->internship_company->ending_date }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="py-2 row">
                        <div class="col-sm-12 col-lg-6 col-xl-4 mb-2">
                            <div class="input-group border-a rounded">
                                <span class="input-group-text fw-bold">Superviser</span>
                                <input type="text" class="form-control bg-white" disabled value="{{ $student->internship_company->supervisor_name }}">
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-6 col-xl-4 mb-2">
                            <div class="input-group border-a rounded">
                                <span class="input-group-text fw-bold">Email</span>
                                <input type="text" class="form-control bg-white" disabled value="{{ $student->internship_company->supervisor_email }}">
                            </div>
                        </div>
                    </div>


                    <div class="py-5 table-responsive">
                        <div class="table-responsive">
                            <table class="table table-bordered border-dark w-100">
                                <thead class="table-primary">
                                    <th>Description of Tasks</th>
                                    <th>Technologies</th>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td>{{ $student->internship_company->description }}</td>
                                        <td>{{ $student->internship_company->technologies }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="py-2">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="input-group border border-1 border-dark rounded" style="height: 8rem;">
                                    <span class="input-group-text bg-primary-subtle fw-bold">Supervisor Notes</span>
                                    <textarea class="form-control bg-white" disabled>{{ $student->internship_company->supervisor_note }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif



        @if (false)
            <section class="container py-5 mx-auto">
                <h2 class="fw-light">Weekly Following Report</h2>

                <div class="container pt-2">
                    <h3 class="fw-light">name Week</h3>

                    <div class="py-2 table-responsive">
                        <div class="table-responsive">
                            <table class="table table-bordered border-dark w-100">
                                <thead class="table-primary">
                                    <th style="width: 13rem;">Task</th>
                                    <th>Software and Hardware</th>
                                    <th style="width: 2rem;">Hours</th>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td>task</td>
                                        <td>sw_hw</td>
                                        <td>hour</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        @endif

    </main>

@endsection
