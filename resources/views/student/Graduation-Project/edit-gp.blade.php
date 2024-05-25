@extends('base')

@section('tab-title', 'Graduation Project Form')

@section('content')
<main class="container-fluid py-5 px-4 col-lg-12 col-xl-9">
    <section id="grad-project" class="container p-3">
        <h1 id="title">Graduation Project</h1>


        <div class="container py-2">

            @session('GpFilledSuccessfully')
                <div class="alert alert-success">{{ session('GpFilledSuccessfully') }}</div>
            @endsession


            <form action="{{ route('graduation-project.store') }}" method="post">
                @csrf

                <div class="row mt-3 mb-5">
                    <!-- List Of Majors -->
                    <div class="col-sm-12 col-md-10 col-lg-4 mb-2">
                        <div class="input-group mx-3 border-a rounded">
                            <select class="form-select form-select" name="department_id">
                                @foreach ($departments as $department)
                                    @if($department->name == $gp->department->name)
                                        <option selected value="{{ $department->id }}">{{ $department->name }}</option>
                                    @else
                                        <option selected value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @error('department_id')
                            <div class="text-danger ps-4">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Semester -->
                    <div class="col-sm-12 col-md-10 col-lg-4 mb-2">
                        <div class="input-group mx-3 border-a rounded">
                            @php $semesters = ["first", "second", "summer"] @endphp
                            <select class="form-select form-select" name="semester">
                                @foreach ($semesters as $semester)
                                    @if ($semester == $gp->semester)
                                        <option selected value="{{ $gp->semester }}">{{ ucfirst($gp->semester) }}</option>
                                    @else
                                        <option selected value="{{ $semester }}">{{ ucfirst($semester) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @error('semester')
                            <div class="text-danger ps-4">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <div class="container px-2 py-2">
                    <h2>Students Info</h2>


                    <ul>
                        @foreach ($rejected as $rej)
                            <li class="text-danger">
                                {{ $rej }}
                            </li>
                        @endforeach
                    </ul>

                    <table class="table table-bordered table-striped mx-auto my-3 shadow-lg" style="width: 98%;">
                        <thead class="table-primary">
                            <th style="width: 0%;">#</th>
                            <th>Full Name</th>
                            <th>Student ID</th>
                            <th>Major</th>
                        </thead>

                        <tbody class="table-group-divider">
                            @for ($i = 1; $i <= $student_no; $i++)
                                <tr>
                                    <th>{{ $i }}</th>
                                    <td>
                                        <input type="text" value="{{ old('name'.$i) }}"
                                        class="form-control" name="name{{ $i }}" placeholder="Write Here">
                                    </td>
                                    <td>
                                        <input type="text" value="{{ old('id'.$i) }}"
                                        class="form-control" name="id{{ $i }}" placeholder="Make sure you write it correctly">
                                    </td>
                                    <td>
                                        <input type="text" value="{{ old('major'.$i) }}"
                                        class="form-control" name="major{{ $i }}" placeholder="Write Here">
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>



                <div>
                    <table class="table table-bordered table-striped mx-auto my-5" style="width: 98%;">
                        <thead class="bg-primary">
                            <th style="width: 0%;">#</th>
                            <th>Full Name</th>
                            <th>Student ID</th>
                            <th>Major</th>
                        </thead>

                        <tbody class="table-group-divider">
                            @foreach ($gp->students as $student)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $student->user->first_name }} {{ $student->user->last_name }}</td>
                                    <td>{{ $student->user->university_id }}</td>
                                    <td>{{ $student->user->department->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>




                <div class="container px-2 py-5" id="project-info">
                    <h2>Project Info</h2>

                    <div class="col-sm-12 col-lg-6 mb-3 px-3 pt-3">
                        <span class="fw-bold">Project Type : </span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border border-1 border-primary"
                            type="radio" name="type" id="app" value="Application"
                            @checked($gp->type == "Application")>
                            <label class="form-check-label" for="app">Application</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input border border-1 border-primary"
                            type="radio" name="type" id="re" value="Research"
                            @checked($gp->type == "Research")>
                            <label class="form-check-label" for="re">Research</label>
                        </div>
                        @error('type')
                            <div class="text-danger ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="pb-3">
                        <div class="row px-3">
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <div class="input-group ms-0 border-a rounded">
                                    <span class="input-group-text fw-bold">Supervisor</span>
                                    <input type="text" class="form-control" value="{{ old('supervisor_1') }}" name="supervisor_1">
                                </div>
                                @error('supervisor_1')
                                    <div class="text-danger ps-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-lg-6 mb-3">
                                <div class="input-group ms-0 border-a rounded">
                                    <span class="input-group-text fw-bold">Email</span>
                                    <input type="text" class="form-control" value="{{ old('email_1') }}" name="email_1">
                                </div>
                                @error('email_1')
                                    <div class="text-danger ps-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row px-3">
                        <div class="col-sm-12 col-lg-6 mb-3">
                            <div class="input-group ms-0 border-a rounded">
                                <span class="input-group-text fw-bold">Supervisor</span>
                                <input type="text" class="form-control" value="{{ old('supervisor_2') }}" name="supervisor_2">
                            </div>
                            @error('supervisor_2')
                                <div class="text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-lg-6 mb-3">
                            <div class="input-group ms-0 border-a rounded">
                                <span class="input-group-text fw-bold">Email</span>
                                <input type="text" class="form-control" value="{{ old('email_2') }}" name="email_2">
                            </div>
                            @error('email_2')
                                <div class="text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="px-3">
                        <div class="mb-3">
                            <div class="input-group border-a rounded">
                                <span class="input-group-text fw-bold">Project Name</span>
                                <input type="text" class="form-control" value="{{ $gp->name }}" name="name">
                            </div>
                            @error('name')
                                <div class="text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="input-group border-a rounded">
                                <span class="input-group-text fw-bold">Project Idea</span>
                                <textarea name="idea" class="form-control"
                                style="height: 7rem">{{ $gp->idea }}</textarea>
                            </div>
                            @error('idea')
                                <div class="text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="input-group border-a rounded">
                                <span class="input-group-text fw-bold">Project Goal</span>
                                <textarea name="goal" class="form-control"
                                style="height: 7rem">{{ $gp->goal }}</textarea>
                            </div>
                            @error('goal')
                                <div class="text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="input-group border-a rounded">
                                <span class="input-group-text fw-bold">Technologies</span>
                                <textarea name="technologies" class="form-control"
                                style="height: 7rem">{{ $gp->technologies }}</textarea>
                            </div>
                            @error('technologies')
                                <div class="text-danger ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="container row mx-3">
                    <input type="submit" value="Submit" class="btn btn-primary p-2 col-sm-12 col-lg-5">
                </div>

            </form>
        </div>

    </section>

    {{ Request::session()->forget('rejectedStudents') }}
</main>

@endsection
