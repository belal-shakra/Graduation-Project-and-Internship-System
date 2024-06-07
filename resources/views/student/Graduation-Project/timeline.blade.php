@extends('base')

@section('tab-title', 'Timeline')

@section('content')
<main class="container-fluid py-5 px-4 mt-5 col-lg-12 col-xl-9">

    <h1 class="ps-2">Timeline</h1>


    <section class="container m-3">
        <div class="p-3 my-5 rounded bg-white shadow-lg">
            <h2 class="fw-light">Create Post</h2>

            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div id="label" class="my-3">
                    @foreach ($labels as $label)
                        <div class="d-inline-block">
                            <input type="checkbox" class="btn-check" id="{{ $label->name }}" name="{{ $loop->iteration }}">
                            <label class="btn btn-outline-{{ $label->class }} py-0 px-1" for="{{ $label->name }}">{{ $label->name }}</label>
                        </div>
                        @error($loop->iteration)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="input-group border-a rounded mb-3">
                            <label for="file" class="input-group-text fw-bold">Upload Files</label>
                            <input class="form-control" type="file" id="file" name="file" multiple>
                        </div>
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control post border" id="post" placeholder="" name="post"
                    style="height: 10rem"></textarea>
                    <label for="post">Post</label>

                    @error('post')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="submit" value="Post" class="btn btn-primary px-3">
                    <input type="reset" value="Clear" class="btn btn-danger px-3">
                </div>
            </form>
        </div>
    </section>



    <section class="container m-3">
        @foreach ($posts as $post)
            <div class="shadow-lg rounded my-5 bg-white" id="{{ $post->user->university_id }}">
                <div class="p-3 border-bottom border-1 border-secondary" >
                    <div class="d-flex align-items-center justify-content-between">
                        <div id="head" class="fw-bold">
                            @if ($post->label_pattern[0] == 1 || $post->label_pattern[13] == 1 )
                                <div class="spinner-grow text-danger" style="height: 20px; width: 20px;"></div>
                            @else
                                <i class="bi bi-circle-fill text-primary"></i>
                            @endif
                            <span class="ps-3 pe-2">{{ $post->created_at->format('D, j-n-Y') }}</span>
                        </div>
    
                        @if ($post->user_id == Auth::user()->id)
                            <div>
                                <i class="bi bi-three-dots fs-5" data-bs-toggle="dropdown"></i>
                                <ul class="dropdown-menu shadow">
                                    <li>
                                        <form action="{{ route('post.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="bg-danger text-white dropdown-item">
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
    
                    
                    <div id="label" class="my-3">
                        @foreach ($labels as $label)
                            @if ($post->label_pattern[$loop->iteration-1])
                                <span class="badge text-bg-{{ $label->class }}">{{ $label->name }}</span>
                            @endif
                        @endforeach
                    </div>
    
                    <div id="body" class="px-3 py-">
                        <p class="lead">{!! nl2br($post->post) !!}</p>
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
                        <span>
                            by <b>{{ $post->user->first_name }} {{ $post->user->last_name }}</b>
                            at {{ $post->created_at->format('H:i') }}
                        </span>
                    </div>
                </div>


                {{-- Comments --}}
                <div class="accordion accordion-flush" id="comment-section">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#comment{{ $loop->iteration }}">
                                {{ count($post->comments) }} Comments
                            </button>
                        </h2>
                        <div id="comment{{ $loop->iteration }}" class="accordion-collapse collapse show p-2" data-bs-parent="#comment-section">
                            <div class="py-3">
                                <form action="{{ route('comment.store', $post) }}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <textarea class="form-control border border-1 border-secondary comment"
                                        name="comment">{{ old('comment') }}</textarea>
                                        <input type="submit" class="btn btn-outline-primary" value="comment">
                                    </div>
                                    @error('comment')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </form>
                            </div>


                            <div class="accordion">
                                <div class="accordion-item">
                                    <div class="pb-3 px-3">
                                        <a href="" data-bs-toggle="collapse" data-bs-target="#all_comments{{ $loop->iteration }}" class="text-decoration-none">
                                            all comments ({{ count($post->comments) }})
                                        </a>
                                    </div>
                                    <div id="all_comments{{ $loop->iteration }}" class="accordion-collapse collapse all_comments">
                                        @foreach ($post->comments as $comment)
                                            <div class="accordion-body">
                                                <div class="py-1 d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <i class="bi bi-person-circle fs-4"></i>
                                                        <strong class="ps-2 pe-1">
                                                            {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                                                        </strong>
                                                        <span class="text-secondary fst-italic">3h ago</span>
                                                    </div>

                                                    <div>
                                                        <i class="bi bi-three-dots fs-5" data-bs-toggle="dropdown"></i>
                                                        <ul class="dropdown-menu shadow">
                                                            <li>
                                                                <form action="{{ route('comment.destroy', $comment) }}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <input type="submit" value="Delete" class="bg-danger text-white dropdown-item">
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="px-3">{!! nl2br($comment->comment) !!}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>


</main>

@endsection
