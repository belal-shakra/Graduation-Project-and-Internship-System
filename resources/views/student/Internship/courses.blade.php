@extends('base')


@section('tab-title', 'Internship | Courses')
@section('content')


    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">
        <h1 class="ps-3">Internship - Courses</h1>




        <section class="container py-2">
            <div class="pb-5">
                @session('course_added')
                    <div class="alert alert-success">{{ session('course_added') }}</div>
                @endsession

                <form action="{{ route('course.store') }}" method="post" enctype="multipart/form-data" >
                    @csrf

                    <div id="course-form">
                        <div id="courses">
                            <div class="my-4 alert alert-secondary rounded py-1 shadow">

                                <div class="container row mt-3 mb-1">
                                    <div class="col-12 col-sm-12 col-md-10 col-lg-4 mb-1">
                                        <div class="input-group border-a rounded">
                                            <label class="input-group-text fw-bold">Course</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                        </div>
                                        @error('name')
                                            <span class="text-danger ps-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-10 col-lg-4 mb-1">
                                        <div class="input-group border-a rounded">
                                            <label class="input-group-text fw-bold">Hours</label>
                                            <input type="number" name="hour" class="form-control" value="{{ old('hour') }}">
                                        </div>
                                        @error('hour')
                                            <span class="text-danger ps-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="input-group border-a rounded">
                                        <label class="input-group-text fw-bold">Course Provider</label>
                                        <input type="text" name="provider" class="form-control" value="{{ old('provider') }}">
                                    </div>
                                    @error('provider')
                                        <span class="text-danger ps-2">{{ $message }}</span>
                                    @enderror

                                    <div class="my-3">
                                        <label class="form-label fw-bold ps-2">Upload Certificate</label>
                                        <input type="file" name="certificate" value="{{ old('certificate') }}" class="form-control border border-1 border-dark">
                                        @error('certificate')
                                            <span class="text-danger ps-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="container d-flex justify-content-cente">
                            <input type="submit" value="Submit" class="btn btn-primary w-25">
                        </div>
                    </div>

                </form>
            </div>
        </section>




        <section class="container py-2">

            <div>
                @error('u_name') <div class="text-danger">{{ $message }}</div>@enderror
                @error('u_hour') <div class="text-danger">{{ $message }}</div>@enderror
                @error('u_provider') <div class="text-danger">{{ $message }}</div>@enderror
                @error('u_certificate') <div class="text-danger">{{ $message }}</div>@enderror
            </div>

            <div class="py-2 table-responsive">
                <table class="table table-bordered border-dark">
                    <thead class="table-primary">
                        <tr>
                            <th class="px-3 py-2" style="width: 0%;">#</th>
                            <th class="px-3 py-2">Course</th>
                            <th class="px-3 py-2" style="width: 0%;">Hour</th>
                            <th class="px-3 py-2">Provider</th>
                            <th class="px-3 py-2" colspan='2' style="width: 18%;">Certificate</th>
                            <th class="px-3 py-2">Note</th>
                            <th class="px-3 py-2">Update</th>
                            <th class="px-3 py-2">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($student->internship_courses as $course)
                            <tr>
                                <form action="{{ route('course.update', $course) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')

                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td class="p-1"><input type="text" value="{{ $course->name }}" name="u_name"></td>
                                    <td class="p-1"><input type="number" value="{{ $course->hour }}" name="u_hour"></td>
                                    <td class="p-1"><input type="text" value="{{ $course->provider }}" name="u_provider"></td>

                                    <td class="p-2" >
                                        <a href="" class="d-inline-block text-truncate" style="max-width: 15rem;">
                                            {{ $course->certificate }}
                                        </a>
                                    </td>
                                    <td class="p-1" style="width: 8%;"><input type="file" name="u_certificate" class="form-control"></td>

                                    <td class="p-1" style="width: 0%;">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#note_{{ $loop->iteration }}">
                                            Click
                                        </button>
                                    </td>

                                    <td class="p-1" style="width: 0%;"><button type="submit" class="btn btn-primary">Update</button></td>
                                    <td class="p-1" style="width: 0%;"><button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete_{{ $loop->iteration }}">Delete</button></td>
                                </form>
                            </tr>


                            <div class="modal fade" id="note_{{ $loop->iteration }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $course->name }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($course->acceptance)
                                                <h4>Accepted</h4>
                                                <p>{{ $course->supervisor_note }}</p>
                                            @elseif ($course->acceptance == 0 && $course->supervisor_note)
                                                <h3>Rejected</h3>
                                                <p>{{ $course->supervisor_note }}</p>
                                            @else
                                                <p>There is no note yet.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="delete_{{ $loop->iteration }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="title">Delete Course</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure to delete this course ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('course.destroy', $course) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" value="Delete" class="btn btn-danger">
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






        <section id="modal">
            <div class="modal fade" id="delete_m">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="title">Delete Course</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to delete this course ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger">soso</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>


@endsection
