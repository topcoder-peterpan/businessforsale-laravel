<form class="form-horizontal" action="{{ route('admin.contact.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row ">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('contact_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->contact_background_path) }}" name="contact_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_contact_settings') }}
            </button>
        </div>
    </div>
</form>
