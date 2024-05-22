@extends('base')

@section('tab-title', 'Graduation Project Teams')
@section('content')
    <main class="container-fluid py-5 mt-5 col-lg-12 col-xl-9">
        <h1 class="ps-3 py-4 fw-light">Graduation Project Teams</h1>

        <section class="container py-1 mx-auto row">
            <div class="col-sm-12 col-md-4 col-lg-6 col-xl-3 mb-5">
                <div class="card border border-3 border-primary shadow" style="min-height: 24rem;">
                    <h5 class="card-header text-center p-1 bg-primary text-white rounded-0">Team 1</h5>
                    <ul class="list-group list-group-flush" style="min-height: 10rem;">
                        <li class="list-group-item">Belal Shakra</li>
                    </ul>
                    <div class="card-body">
                        <h5></h5>
                        <h5 class="card-title text-truncate">project_name</h5>
                        <p class="card-text text-truncate">project_idea</p>
                    </div>
                    <div class="card-body">
                        <a href="" class="card-link btn btn-primary">More Details</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
