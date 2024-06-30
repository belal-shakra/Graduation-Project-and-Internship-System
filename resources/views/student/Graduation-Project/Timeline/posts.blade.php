<section class="container m-3">
    @foreach ($posts as $post)
        <div class="shadow-lg rounded my-5 bg-white" id="{{ $post->created_at->format('si') }}">
            <div class="p-3 border-bottom border-1 border-secondary" >
                <div class="d-flex align-items-center justify-content-between">
                    <div id="head" class="fw-bold">
                        @if ($post->label_pattern[0] == 1 || $post->label_pattern[13] == 1 )
                            <div class="spinner-grow text-danger" style="height: 20px; width: 20px;"></div>
                        @else
                            <i class="bi bi-circle-fill text-primary"></i>
                        @endif
                        <span class="ps-3 pe-2">{{ Carbon\Carbon::parse($post->created_at, 'UTC')->setTimezone('Asia/Amman')->format('D, j-n-Y') }}</span>
                    </div>

                    @if ($post->user_id == Auth::user()->id)
                        <div>
                            <i class="bi bi-three-dots fs-5" data-bs-toggle="dropdown"></i>
                            <ul class="dropdown-menu shadow">
                                <li>
                                    <form action="" method="post">
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

                        <span class="d-inline-block text-truncate" style="max-width: 70%;">
                            @foreach ($post->files as $file)
                                <div>
                                    @if (in_array($file->extension, ['jpeg','png', 'gif', 'webp', 'bmp']))
                                        <img src="{{ asset('assets/img/all/img.png') }}" alt="img" style="width:3%;">
                                    @elseif (in_array($file->extension, ['exe', 'xls', 'zip', 'txt', 'html', 'css', 'js', 'docx', 'ppt', 'pdf' ,'mp4']))
                                        <img src="{{ asset('assets/img/all/'.$file->extension .'.png') }}" alt="img" style="width:3%;">
                                    @else
                                        <img src="{{ asset('assets/img/all/txt.png') }}" alt="img" style="width:3%;">
                                    @endif
                                    
                                    <a href="{{ asset('storage') }}/{{ $file->path }}/{{ $file->file }}" target="_blank">
                                        {{ explode('-', $file->file, 2)[1] }}
                                    </a>
                                </div>
                            @endforeach
                        </span>
                    </div>
                </div>

                <div id="footer" class="my-2 mt-3 px-3">
                    <span>
                        by <b>{{ $post->user->first_name }} {{ $post->user->last_name }}</b>
                        at {{ Carbon\Carbon::parse($post->created_at, 'UTC')->setTimezone('Asia/Amman')->format('H:i') }}
                    </span>
                </div>
            </div>


            @include('student.Graduation-Project.Timeline.comments')


        </div>
    @endforeach
</section>