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
                        @foreach ($students as $student)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $student->user->first_name }} {{ $student->user->last_name }}</td>
                                <td>{{ $student->user->university_id }}</td>
                                <td>{{ $student->user->email }}</td>
                                <td><a href="{{ route('supervisor.report', $student) }}">view report</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection
