@extends('base')

@section('tab-title', 'Graduation Project Teams')
@section('content')

    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">
        <h1 class="ps-3 py-4 fw-light">Graduation Project Teams</h1>


        <section class="container mt-4">
            <div class="row">

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-3 mb-5" style="min-width: 18rem; min-height: 17rem;">
                    <div class="card border-3 border-primary h-100">
                        <h5 class="card-header text-center p-1 bg-primary text-white rounded-0">Team 1</h5>
                        <div class="card-body text-primary p-1 pb-0">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Belal Shakrra</td>
                                        <td>0192452</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center border-3 border-primary">
                            <span class="fw-semibold text-truncate">project_name</span>
                            <a class="btn btn-primary btn-sm" href="" role="button">Details</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

@endsection
