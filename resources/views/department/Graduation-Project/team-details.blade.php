@extends('base')

@section('tab-title', 'Team Details')
@section('content')

    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">
        <h1 class="ps-3 py-4 fw-light">Team Details</h1>


        <section class="container mx-auto">
            <div class="py-2 pb-5 table-responsive">
                <table class="table-bordered bg-white">
                    <thead>
                        <th class="px-3 py-2">project_name</th>
                        <th class="px-3 py-2">project_type</th>
                        <th class="px-3 py-2">semester</th>
                        <th class="px-3 py-2">department</th>
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
                            <tr>
                            <th style="width: 0%;">1</th>
                            <td>Belal Shakra</td>
                            <td>0192452</td>
                            <td>Computer Science</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>



        <section class="container mt-4">
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    <table class="table table-striped">
                        <thead class="table-primary">
                            <th>#</th>
                            <th>Supervisor</th>
                            <th>Email</th>
                        </thead>
                        <tbody class="table-group-divider">
                            <tr>
                                <th style="width: 0%;">1</th>
                                <td>superviser_1</td>
                                <td>email_1</td>
                            </tr>
                            <tr>
                                <th style="width: 0%;">2</th>
                                <td>team.superviser_2</td>
                                <td>email_2</td>
                            </tr>
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
                            <td>project_idea</td>
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
                            <td>project_goal</td>
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
                            <td>technologies</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

@endsection

