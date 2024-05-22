@extends('base')

@section('tab-title', 'Student\'s report')
@section('content')

    <main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">

        <div class="ps-3 py-4">
            <h1 class="fw-light">Internship Report</h1>
            <p class="lead ps-2"></p>
        </div>


        <section class="container mx-auto">
            <div class="py-2">
                <table class="table-bordered bg-white">
                    <thead>
                        <th class="px-3 py-2">Belal Shakra</th>
                        <th class="px-3 py-2">0192452</th>
                        <th class="px-3 py-2">bla0192452@ju.edu.jo</th>
                    </thead>
                </table>
            </div>
        </section>


        <section class="container mx-auto py-5">
            <h2 class="fw-light">Courses</h2>
            <div class="py-2 table-responsive">
                <table class="table table-bordered border-dark">
                    <thead class="table-primary">
                        <th style="width: 0%;">#</th>
                        <th class="px-3 py-2">Course</th>
                        <th class="px-3 py-2">Hours</th>
                        <th class="px-3 py-2">Provider</th>
                        <th class="px-3 py-2">Certificate</th>
                        <th class="px-3 py-2" colspan="2">Status</th>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <th>1</th>
                            <td>course name</td>
                            <td>course.hour</td>
                            <td>course.provider</td>
                            <td class="p-2" style="width: 15rem;">
                                <a href="" class="d-inline-block text-truncate" style="max-width: 15rem;">certificate</a>
                            </td>
                            <td  style="width: 0%;" class="border-end border-0">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approve-courses[must be unique]">Approve</button>
                            </td>
                            <td  style="width: 0%;">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#disapprove-courses[must be unique]">Disapprove</button>
                            </td>

                            <div class="modal fade" id="approve-courses[must be unique]">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Do you want to write any comment ?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{% url 'app_courses' course.id %}" method="post">

                                                <div class="mb-3">
                                                    <label class="d-block p-1">Write Here:</label>
                                                    <textarea name="app[must be unique]" id="" class="border border-1 border-dark rounded w-100 p-1" style="height: 7rem;"></textarea>
                                                </div>

                                                <div class="modal-footer">
                                                    <input type="submit" value="Submit" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="disapprove-courses[must be unique]">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Why do want to reject internship ?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <div class="mb-3">
                                                    <label class="d-block p-1">Write Here:</label>
                                                    <textarea required name="disapp[must be unique]" id=""
                                                    class="border border-1 border-dark rounded w-100 p-1" style="height: 7rem;"></textarea>
                                                </div>

                                                <div class="modal-footer">
                                                    <input type="submit" value="Disapprove" class="btn btn-danger">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>


        <section class="container mx-auto">
            <div class="py-3">
                <h2 class="fw-light">Company</h2>
                <div class="py-2 table-responsive">
                    <table class="table table-bordered border-dark">
                        <thead class="table-primary">
                            <th class="px-3 py-2">Company</th>
                            <th class="px-3 py-2">Address</th>
                            <th class="px-3 py-2">Start</th>
                            <th class="px-3 py-2">End</th>
                        </thead>
                        <tbody class="table-group-divider">
                            <tr>
                                <td>Hoho Company</td>
                                <td>Amman, Jordan</td>
                                <td>dd-mm-yyyy</td>
                                <td>dd-mm-yyyy</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="py-2 row">
                    <div class="col-sm-12 col-lg-6 col-xl-4 mb-2">
                        <div class="input-group border-a rounded">
                            <span class="input-group-text fw-bold">Superviser</span>
                            <input type="text" class="form-control bg-white" disabled value="comppany's supervisor name">
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 col-xl-4 mb-2">
                        <div class="input-group border-a rounded">
                        <span class="input-group-text fw-bold">Email</span>
                        <input type="text" class="form-control bg-white" disabled value="comppany's supervisor email">
                        </div>
                    </div>
                </div>


                <div class="py-2 table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered border-dark w-100">
                            <thead class="table-primary">
                                <th>Description of Tasks</th>
                                <th>Technologies</th>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>description_of_tasks</td>
                                    <td>technologies</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approve-company">Approve</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#disapprove-company">Disapprove</button>
                </div>
            </div>
        </section>


        <section class="container mx-auto">

            <div class="modal fade" id="approve-company" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Do you want to write any comment ?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{% url 'app_company' student.id %}" method="post">
                                <div class="mb-3">
                                    <label>Write Here:</label>
                                </div>

                                <div class="modal-footer">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="disapprove-company" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Why do want to reject internship ?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label>Write Here:</label>
                                </div>

                                <div class="modal-footer">
                                    <input type="submit" value="Disapprove" class="btn btn-danger">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>


        <section class="container py-5 mx-auto">
            <h2 class="fw-light">Weekly Following Report</h2>

            <div class="container pt-2">
                <h3 class="fw-light">First Week</h3>

                <div class="py-2 table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered border-dark w-100">
                            <thead class="table-primary">
                                <th style="width: 13rem;">Task</th>
                                <th>Software and Hardware</th>
                                <th style="width: 2rem;">Hours</th>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>task name</td>
                                    <td>sw_hw</td>
                                    <td>hour</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>

    </main>

@endsection
