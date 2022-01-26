<form class="form-horizontal" action="{{ route('admin.getmembership.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row ">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('get_membership_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->get_membership_background_path) }}" name="get_membership_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="offset-1 col-md-3 ">
            <div class="form-group">
                <label>{{ __('get_membership_image') }}</label>
                <div class="row">
                    @if (file_exists($cms->get_membership_image))
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->get_membership_image) }}" name="get_membership_image"
                        autocomplete="image">
                    @else
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset('backend/image/logo-default.png') }}"
                        name="get_membership_image">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('upate_membership_settings') }}
            </button>
        </div>
    </div>
</form>

