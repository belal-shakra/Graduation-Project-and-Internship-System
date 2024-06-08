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
                      <input class="form-control" type="file" id="files" name="files[]" multiple>
                  </div>
                  @error('files[]')
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