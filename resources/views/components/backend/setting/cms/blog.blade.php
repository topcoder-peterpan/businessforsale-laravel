<form class="form-horizontal" action="{{ route('admin.blog.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row ">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('blog_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->blog_background_path) }}" name="blog_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_blog_settings') }}
            </button>
        </div>
    </div>
</form>
