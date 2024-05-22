<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/img/all/ju-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">





    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Page Not Found</title>
</head>

<body class="row">

    @include('parts.simple-header')



    <main class="h-75">
        <section class="container py-5  d-flex justify-content-center align-items-center" style="margin-top: 4rem;">
            <img src="{{ asset('assets') }}/img/all/bg-404.png" alt="404" class="img-fluid">
        </section>
    </main>



    @include('parts.footer')

    <script src="{{ asset('assets/javascript/grad-project.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>






