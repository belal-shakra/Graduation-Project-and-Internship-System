@extends('base')

@section('tab-title', 'Login')
@section('content')

    <!-- Login Form -->
    <section id="login" class="container  py-5">
        <div class="row d-flex justify-content-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="py-5 px-4 border-a rounded shadow-lg">
                    <h2 class="fw-bold mb-5 text-uppercase text-center">Login</h2>

                    <form action="" method="post">
                        <div class="form-floating mb-3 shadow border-a rounded">
                            <label for="email">Username</label>
                        </div>

                        <div class="form-floating mb-3 shadow border-a rounded">
                            <label for="pass">Password</label>
                        </div>

                        <div class="mb-5 text-center text-danger">
                            <span>allow_error</span>
                            <span>auth_error</span>
                            <span>valid_error</span>
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
