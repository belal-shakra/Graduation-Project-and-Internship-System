@extends('base')

@section('tab-title', 'Students List')
@section('content')
    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">
        <div class="ps-3 py-4">
            <h1 class="fw-light">Students List</h1>
            <p class="lead ps-2">List of students that you supervise them in this semester.</p>
        </div>



        <section class="container mx-auto row">
            <div class="containe table-responsive p-3">
                <table class="table table-striped table-bordered shadow">
                    <thead>
                        <tr>
                            <th style="width: 0%;">#</th>
                            <th  style="min-width: 8rem;">Name</th>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Report</th>
                        </tr>
                    </thead>

                    <tbody class="table-group-divider">
                        <tr>
                        <th>1</th>
                        <td>Belal Shakra</td>
                        <td>0192452</td>
                        <td>bla0192452@ju.edu.jo</td>
                        <td><a href="">view report</a></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection
