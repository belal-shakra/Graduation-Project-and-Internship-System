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