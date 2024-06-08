@extends('base')

@section('tab-title', 'Graduation Project Teams')
@section('content')
    <main class="container-fluid py-5 mt-5 col-lg-12 col-xl-9">
        <h1 class="ps-3 py-4 fw-light">Graduation Project Teams</h1>

        <section class="container mt-4">
            <div class="row">
                @foreach ($teams as $team)
                    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-3 mb-5" style="min-width: 18rem; min-height: 17rem;">
                        <div class="card border-3 border-primary h-100">
                            <h5 class="card-header text-center p-1 bg-primary text-white rounded-0">Team {{ $loop->iteration }}</h5>
                            <div class="card-body text-primary p-1 pb-0">
                                <table class="table">
                                    <tbody>
                                        @foreach ($team->students as $student)
                                            <tr>
                                                <td>{{ $student->user->first_name }} {{ $student->user->last_name }}</td>
                                                <td>{{ $student->user->university_id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center border-3 border-primary">
                                <span class="fw-semibold text-truncate">{{ $team->name }}</span>
                                <a href="{{ route('department.team-details', $team) }}" class="btn btn-primary btn-sm">Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </section>
    </main>
@endsection
