@extends('base')

@section('tab-title', 'Student\'s report')
@section('content')

    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">

        <div class="ps-3 py-4">
            <h1 class="fw-light">Internship Report</h1>
            <p class="lead ps-2"></p>
        </div>


        <section class="container mx-auto">
            <div class="py-2">
                <table class="table-bordered bg-white">
                    <thead>
                        <th class="px-3 py-2">{{ $student->user->first_name }} {{ $student->user->last_name }}</th>
                        <th class="px-3 py-2">{{ $student->user->university_id }}</th>
                        <th class="px-3 py-2">{{ $student->user->email }}</th>
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
                            <th style="width: 0%;">#</th>
                            <th class="px-3 py-2">Course</th>
                            <th class="px-3 py-2">Hours</th>
                            <th class="px-3 py-2">Provider</th>
                            <th class="px-3 py-2">Certificate</th>
                            <th class="px-3 py-2" colspan="2">Status</th>
                        </thead>
                        <tbody class="table-group-divider">
                            
                            @foreach ($student->internship_courses as $course)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->hour }}</td>
                                    <td>{{ $course->provider }}</td>
                                    <td class="p-2" style="width: 15rem;">
                                        @if ($course->certificate)
                                            <a href="{{ asset('storage/Internship/courses/'.$student->id) }}/{{ $course->certificate }}"
                                            class="d-inline-block text-truncate" style="max-width: 15rem;" target="_black">
                                                certificate
                                            </a>
                                        @endif
                                    </td>
                                    <td  style="width: 0%;" class="border-end border-0">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approve-{{ $loop->iteration }}">Approve</button>
                                    </td>
                                    <td  style="width: 0%;">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#disapprove-{{ $loop->iteration }}">Disapprove</button>
                                    </td>
                                </tr>


                                <div class="modal fade" id="approve-{{ $loop->iteration }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Do you want to write any comment ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                action="{{ route('supervisor.storeCourseNote', ['course'=>$course, 'status'=>true]) }}" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="d-block p-1">Write Here:</label>
                                                        <textarea name="supervisor_note" class="border border-1 border-dark rounded w-100 p-1" style="height: 7rem;"></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <input type="submit" value="Submit" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="disapprove-{{ $loop->iteration }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Why do want to reject internship ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('supervisor.storeCourseNote', ['course'=>$course, 'status'=>false]) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="d-block p-1">Write Here:</label>
                                                        <textarea name="supervisor_note" class="border border-1 border-dark rounded w-100 p-1" style="height: 7rem;"></textarea>
                                                        class="border border-1 border-dark rounded w-100 p-1" style="height: 7rem;"></textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <input type="submit" value="Disapprove" class="btn btn-danger">
                                                    </div>
                                                </form>
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
                <div class="py-3">
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
                                <input type="text" class="form-control bg-white" disabled
                                value="{{ $student->internship_company->supervisor_name }}">
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-6 col-xl-4 mb-2">
                            <div class="input-group border-a rounded">
                            <span class="input-group-text fw-bold">Email</span>
                            <input type="text" class="form-control bg-white" disabled
                            value="{{ $student->internship_company->supervisor_email }}">
                            </div>
                        </div>
                    </div>


                    <div class="py-2 table-responsive">
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



                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approve-company">Approve</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#disapprove-company">Disapprove</button>
                    </div>
                </div>
            </section>


            <section class="container mx-auto">
                <div class="modal fade" id="approve-company" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Do you want to write any comment ?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('supervisor.storeCompanyNote', ['company'=>$student->internship_company, 'status'=>true]) }}"
                                    method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Write Here:</label>
                                        <textarea name="supervisor_note" class="border border-1 border-dark rounded w-100 p-1" style="height: 7rem;"></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="disapprove-company" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Why do want to reject internship ?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('supervisor.storeCompanyNote', ['company'=>$student->internship_company, 'status'=>0]) }}"
                                    method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Write Here:</label>
                                        <textarea name="supervisor_note" class="border border-1 border-dark rounded w-100 p-1" style="height: 7rem;"></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="submit" value="Submit" class="btn btn-danger">
                                    </div>
                                </form>
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
                    <h3 class="fw-light">First Week</h3>

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
                                        <td>task name</td>
                                        <td>sw_hw</td>
                                        <td>hour</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        @endif

    </main>

@endsection
