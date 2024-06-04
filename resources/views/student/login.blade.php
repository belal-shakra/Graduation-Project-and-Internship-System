@extends('base')

@section('tab-title', 'Login')
@section('content')
    <!-- Login Form -->
    <section id="login" class="container py-5 ">



        <div class="row d-flex justify-content-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="py-5 px-4 border-a rounded shadow-lg">
                    <h2 class="fw-bold mb-5 text-uppercase text-center">Login</h2>

                    <form action="{{ route('login') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <div class="form-floating border border-1 border-dark rounded shadow">
                                <input type="email" class="form-control" id="email" placeholder="" name="email"
                                value="bla0192452@ju.edu.jo"
                                >
                                <label for="email">Email</label>
                            </div>
                            @error('email')
                                <span class="ps-2 text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <div class="form-floating border border-1 border-dark rounded shadow">
                                <input type="password" class="form-control" id="pass" placeholder="" name="password">
                                <label for="pass">Password</label>

                            </div>
                            @error('password')
                                <span class="ps-2 text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-5 text-center text-danger">
                            @session('denied_permission')
                                {{ session('denied_permission') }}
                            @endsession

                        </div>

                        <div class="text-center">
                            <input type="submit" value="Login" class="btn btn-primary btn-lg">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
