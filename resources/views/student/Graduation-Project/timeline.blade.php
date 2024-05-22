@extends('base')

@section('tab-title', 'Timeline')

@section('content')
<main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">

    <h1 class="ps-5">Timeline</h1>
    <div class="alert alert-success">
        Success Alert
    </div>


    <section class="container m-3">
        <div class="p-3 my-5 rounded bg-white shadow-lg">
            <h2 class="fw-light">Create Post</h2>

            <form action="" method="post" enctype="multipart/form-data">
                <div id="label" class="my-3">
                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-danger py-0 px-1" for="important">important</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-primary py-0 px-1" for="doc">documentation</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-info py-0 px-1" for="new_release">new release</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-success py-0 px-1" for="final_release">final release</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-warning py-0 px-1" for="programming">programming</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-dark py-0 px-1" for="research">research</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-secondary py-0 px-1" for="update">update</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-success py-0 px-1" for="web">web</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-dark py-0 px-1" for="mobile">mobile</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-primary py-0 px-1" for="network">network</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-warning py-0 px-1" for="cyber_security">cyber security</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-info py-0 px-1" for="ai">ai</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-secondary py-0 px-1" for="machine_learning">machine learning</label>
                    </div>

                    <div class="d-inline-block">
                        <input type="checkbox">
                        <label class="btn btn-outline-danger py-0 px-1" for="problem">problem</label>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-12 col-lg-6">
                        <label for="file" class="form-labe"></label>
                        <input type="file">
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <label for="post">Post</label>
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                </div>

                <div>
                    <input type="submit" value="Post" class="btn btn-primary px-3">
                    <input type="reset" value="Clear" class="btn btn-danger px-3">
                </div>
            </form>
        </div>
    </section>



    <section class="container m-3">
        <div class="p-3 my-5 rounded bg-white shadow-lg" >
            <div class="d-flex align-items-center justify-content-between">
                <div id="head" class="fw-bold">
                    <div class="spinner-grow text-danger" style="height: 20px; width: 20px;"></div>
                        <i class="bi bi-circle-fill text-primary"></i>
                    <span class="ps-3 pe-2"></span>
                </div>

                <div>
                    <i class="bi bi-three-dots fs-5" data-bs-toggle="dropdown"></i>
                    <ul class="dropdown-menu shadow">
                        <li><a class="dropdown-item" href="">Delete</a></li>
                    </ul>
                </div>
            </div>

            <div id="label" class="my-3">
                <span class="badge text-bg-danger">important</span>
                <span class="badge text-bg-primary">documaentation</span>
                <span class="badge text-bg-info">new release</span>
                <span class="badge text-bg-success">final release</span>
                <span class="badge text-bg-secondary">update</span>
                <span class="badge text-bg-dark">research</span>
                <span class="badge text-bg-warning">programming</span>
                <span class="badge text-bg-success">web</span>
                <span class="badge text-bg-dark">mobile</span>
                <span class="badge text-bg-primary">network</span>
                <span class="badge text-bg-warning">cyber security</span>
                <span class="badge text-bg-info">ai</span>
                <span class="badge text-bg-secondary">machine learning</span>
                <span class="badge text-bg-danger">problem</span>
            </div>


            <div id="body" class="px-3 py-">
                <p class="lead"></p>
            </div>



            <div id="att" class="px-3 mb-2">
                <div class="">
                    <span class="d-inline-block">
                        <img src="{{ asset('assets/img/all/zip.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/exe.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/html.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/css.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/js.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/docx.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/ppt.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/xls.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/pdf.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/mp4.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/img.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                        <img src="{{ asset('assets/img/all/file.png') }}" alt="file-img" class="img-fluid" style="width: 22px;">
                    </span>
                    <span class="d-inline-block text-truncate" style="max-width: 70%;">
                        <a href=""></a>
                    </span>
                </div>
            </div>


            <div id="footer" class="my-2 mt-3 px-3">
                <span>by <b>Belal Shakra</b> at dd-mm-yyyy 00:00</span>
            </div>
        </div>
    </section>


</main>

@endsection
