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


        <section class="container mt-4">
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
                            @foreach ($students as $student)
                                <tr>
                                    <th style="width: 0%;">{{ $loop->iteration }}</th>
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
            <div class="table-responsive my-4">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <th>Project Overview</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="p-3">{{ $project->idea }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="table-responsive my-4">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <th>Project Goals</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="p-3">{{ $project->goal }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="table-responsive my-4">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <th>Project Technologies</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="p-3">{{ $project->technologies }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>



        <section class="container mt-5">
            <h2 class="py-2 fw-light">Project Timeline</h2>

            <section class="container m-3">

                <div class="p-3 my-5 rounded bg-white shadow-lg" >
                    <div id="head" class="fw-bold">
                        <div class="spinner-grow text-danger" style="height: 20px; width: 20px;"></div>
                        <i class="bi bi-circle-fill text-primary"></i>
                        <span class="ps-3 pe-2">Day</span> DD-MM-YYYY
                    </div>

                    <div id="label" class="my-3">
                        <span class="badge text-bg-danger">important</span>
                        <span class="badge text-bg-primary">documaentation</span>
                        <span class="badge text-bg-info">new release</span>
                        <span class="badge text-bg-success">final release</span>
                        <span class="badge text-bg-secondary">update</span>
                        <span class="badge text-bg-dark">research</span>
                        <span class="badge text-bg-warning">programming</span>
                        <span class="badge text-bg-success">web</span>
                        <span class="badge text-bg-dark">mobile</span>
                        <span class="badge text-bg-primary">network</span>
                        <span class="badge text-bg-warning">cyber security</span>
                        <span class="badge text-bg-info">ai</span>
                        <span class="badge text-bg-secondary">machine learning</span>
                        <span class="badge text-bg-danger">problem</span>
                    </div>

                    <div id="body" class="px-3 py-">
                        <p class="lead">post</p>
                    </div>

                    <div id="att" class="px-3 mb-2">
                        <div class="">
                            <span class="d-inline-block">
                                    <img src=" static 'assets/img/all/zip.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/exe.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/html.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/css.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/js.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/docx.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/ppt.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/xls.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/pdf.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/mp4.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/img.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                                    <img src=" static 'assets/img/all/file.png' " alt="file-img" class="img-fluid" style="width: 22px;">
                            </span>
                            <span class="d-inline-block text-truncate" style="max-width: 70%;">
                                <a href=" url 'download_file' file.1.id "></a>
                            </span>
                        </div>
                    </div>

                    <div id="footer" class="my-2 mt-3 px-3">
                        <span>by <b>Belal Shakra</b> at 00:00</span>
                    </div>
                </div>
            </section>
        </section>
    </main>

@endsection
