@extends('base')

@section('tab-title', 'Weekl Following Form')
@section('content')
    <main class="container-fluid py-5 px-4 col-lg-12 col-xl-9">
        <div class="ps-3">
            <h1>Weekly Following Form</h1>
            <p class="lead ps-3">You can submit the form more than one.</p>
        </div>




        <section class="container py-5">
            <h2>Week</h2>

            <form action="" method="post">
                <div id="week-follow">

                    <div class="row">
                        <div class=" col-sm-12 col-lg-3">
                            <select class="form-select mt-4 mb-2 border border-1 border-dark" name="student">
                                <option selected value="">Belal Shakra</option>
                            </select>
                        </div>
                    </div>

                    <div id="week-info" class=" bg-secondary-subtle border border-2 border-secondary-subtle rounded">
                        <div class="container row mt-3 mb-2">
                            <div class="col-sm-12 col-md-10 col-lg-4 mb-1">
                                <div class="input-group border-a rounded">
                                    <label class="input-group-text fw-bold">Task</label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-10 col-lg-4 mb-1">
                                <div class="input-group border-a rounded">
                                    <label class="input-group-text fw-bold">Hours</label>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="input-group mb-3 border-a rounded">
                                <span class="input-group-text fw-bold">Software or <br>Hardware that used</span><br>
                            </div>

                            <div class="container">
                                <input type="hidden" name="week" value=>
                            </div>
                        </div>
                    </div>

                    <div class="container row my-3">
                        <input type="submit" value="Send" class="btn btn-primary w-25 col col-sm-12">
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
