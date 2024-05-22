@extends('base')

@section('tab-title', 'Student Exceeds 90 Hours')
@section('content')

    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">
        <div class="ps-3 py-4">
            <h1 class="fw-light">Students That Exceed 90 Hour</h1>
            <p class="lead ps-2">Students that exceed 90 hour in department, and their status with internship and a graduation project.</p>
        </div>


        <section class="container mx-auto row">
            <div class="containe table-responsive p-3">
                <table class="table table-striped table-bordered shadow">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th style="min-width: 8rem;">Name</th>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Internship</th>
                        <th>Graduation Project</th>
                        </tr>
                    </thead>

                    <tbody class="table-group-divider">
                        <tr>
                            <th>1</th>
                            <td>Belal Shakra</td>
                            <td>0192452</td>
                            <td>bla0192452@ju.edu.jo</td>
                            <td>
                                <i class="bi bi-check-square-fill text-success fs-5">
                                <i class="bi bi-x-square-fill text-danger fs-5"></i>
                            </td>
                            <td>
                                <i class="bi bi-check-square-fill text-success fs-5">
                                <i class="bi bi-x-square-fill text-danger fs-5"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

@endsection
