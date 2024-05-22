@extends('base')

@section('tab-title', 'Internship | Company')
@section('content')

    <main class="container py-5 px-4 my-5 col-lg-12 col-xl-9">





        <section class="container-fluid py-4 px-4">


            <div>
                <h1>Internship - Company</h1>
            </div>


            <form action="{{ route('company.store') }}" method="post">
                @csrf

                <div class="my-4">
                    <h2>Company Info</h2>
                    <div class="container row mt-3 mb-2">
                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mx-3 border-a rounded bg-white">
                                <label class="input-group-text fw-bold">Company</label>
                                <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}">
                            </div>
                            @error('company_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mx-3 border-a rounded bg-white">
                                <label class="input-group-text fw-bold">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}">
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
                                <input type="date" name="starting_date" class="form-control" value="{{ old('starting_date') }}">
                            </div>
                            @error('starting_data')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mx-3 border-a rounded bg-white">
                                <label class="input-group-text fw-bold">End</label>
                                <input type="date" name="ending_date" class="form-control" value="{{ old('ending_date') }}">
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
                                <input type="text" name="supervisor_name" class="form-control" value="{{ old('supervisor_name') }}">
                            </div>
                            @error('supervisor_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-4 mb-3">
                            <div class="input-group mx-3 border-a rounded bg-white">
                                <label class="input-group-text fw-bold">Email</label>
                                <input type="email" name="supervisor_email" class="form-control" value="{{ old('supervisor_email') }}">
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
                                <textarea name="description" class="form-control" style="height: 7rem">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="input-group border-a rounded bg-white">
                                <span class="input-group-text fw-bold">Technologies</span>
                                <textarea name="technologies" class="form-control" style="height: 7rem">{{ old('technologies') }}</textarea>
                            </div>
                            @error('technologies')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>



                <div class=" my-4">
                    <div class="row mt-5">
                        <input type="submit" value="Submit" class="btn btn-primary p-2 m-2 col-sm-12 col-lg-5">
                    </div>
                </div>
            </form>
        </section>


    </main>
@endsection
