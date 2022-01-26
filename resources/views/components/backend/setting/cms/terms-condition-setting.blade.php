<form class="form-horizontal" action="{{ route('admin.terms.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row justify-content-between">
        <div class="offset-1 col-md-6">
            <div class="form-group">
                <label>{{ __('terms_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $termsBackground }}" name="terms_background"
                        autocomplete="image">
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('terms_body') }}</label>
                <div class="row">
                    <textarea id="terms_ck"  class="form-control" name="terms_body"
                        placeholder="{{ __('write_the_answer') }}">{{ $terms }}</textarea>
                    @error('terms_body')
                    <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 offset-1 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_terms_setting') }}
            </button>
        </div>
    </div>
</form>

