@extends('base')

@section('tab-title', 'Timeline')

@section('content')
<main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">

    <h1 class="ps-2">Timeline</h1>


    @include('student.Graduation-Project.Timeline.create-post')

    @include('student.Graduation-Project.Timeline.posts')



</main>

@endsection
