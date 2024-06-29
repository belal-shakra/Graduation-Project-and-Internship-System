@extends('base')

@section('tab-title', 'Edit Internship Company Form')
@section('content')

    <main class="container py-5 px-4 my-5 col-lg-12 col-xl-9">

        <section class="container-fluid py-4 ps-4">

            @session('companyFormFilledSuccessfully')
                <div class="alert alert-success">{{ session('companyFormFilledSuccessfully') }}</div>
            @endsession

            @session('updatedSuccessfully')
                <div class="alert alert-success">{{ session('updatedSuccessfully') }}</div>
            @endsession

            <div class="d-flex justify-content-between">
                <h1>Internship - Company</h1>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#note">Supervisor Note</button>
            </div>


            <form action="{{ route('student.company.update', $company) }}" method="post">
                @csrf
                @method('patch')

                <div class="my-4">
                    <h2>Company Info</h2>
                    <div class="container row mt-3 mb-2">
                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mx-3 border-a rounded bg-white">
                                <label class="input-group-text fw-bold">Company</label>
                                <input type="text" name="company_name" class="form-control" value="{{ $company->company_name }}" autofocus>
                            </div>
                            @error('company_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mx-3 border-a rounded bg-white">
                                <label class="input-group-text fw-bold">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $company->address }}">
                            </div>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="container row mt-3 mb-5 w-75">
                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mx-3 border-a rounded bg-white">
                                <label class="input-group-text fw-bold">Start</label>
                                <input type="date" name="starting_date" class="form-control" value="{{ $company->starting_date }}">
                            </div>
                            @error('starting_data')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mx-3 border-a rounded bg-white">
                                <label class="input-group-text fw-bold">End</label>
                                <input type="date" name="ending_date" class="form-control" value="{{ $company->ending_date }}">
                            </div>
                            @error('ending_data')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="border border-2 border-dark">


                <div class="my-4">
                    <h2>Supervisor Info</h2>
                    <div class="container row mt-3 mb-2">
                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mx-3 border-a rounded bg-white">
                                <label class="input-group-text fw-bold">Full Name</label>
                                <input type="text" name="supervisor_name" class="form-control" value="{{ $company->supervisor_name }}">
                            </div>
                            @error('supervisor_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mx-3 border-a rounded bg-white">
                                <label class="input-group-text fw-bold">Email</label>
                                <input type="email" name="supervisor_email" class="form-control" value="{{ $company->supervisor_email }}">
                            </div>
                            @error('supervisor_email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <hr class="border border-2 border-dark">


                <div class="my-4">
                    <h2>Technical Info</h2>
                    <div class="my-3">
                        <div class="mb-3">
                            <div class="input-group border-a rounded bg-white">
                                <span class="input-group-text fw-bold">Description of Tasks</span>
                                <textarea name="description" class="form-control" style="height: 7rem">{{ $company->description }}</textarea>
                            </div>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="input-group border-a rounded bg-white">
                                <span class="input-group-text fw-bold">Technologies</span>
                                <textarea name="technologies" class="form-control" style="height: 7rem">{{ $company->technologies }}</textarea>
                            </div>
                            @error('technologies')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>



                <div class=" my-4">
                    <div class="row mt-5">
                        <input type="submit" value="Update" class="btn btn-primary p-2 m-2 col-5">
                        <button type="button" class="btn btn-danger p-2 m-2 col-5" data-bs-toggle="modal" data-bs-target="#delete_m">Delete Form</button>
                    </div>
                </div>
            </form>
        </section>



        <section>
            <div class="modal fade" id="delete_m">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="title">Delete Company Form</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to delete this Form ?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('student.company.destroy', $company) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete Form" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section>
            <div class="modal fade" id="note">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5" id="exampleModalLabel">Supervisor Note</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if ($company->acceptance)
                                <h4>Accepted</h4>
                                <p>{{ $company->supervisor_note }}</p>
                            @elseif ($company->acceptance == 0 && $company->supervisor_note)
                                <h3>Rejected</h3>
                                <p>{{ $company->supervisor_note }}</p>
                            @else
                                <p>There is no note yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
