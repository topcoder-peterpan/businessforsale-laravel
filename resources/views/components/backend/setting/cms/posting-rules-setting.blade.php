<form class="form-horizontal" action="{{ route('admin.posting.rules.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row justify-content-between">
        <div class="offset-1 col-md-6">
            <div class="form-group">
                <label>{{ __('posting_rules_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $postingRulesBackground }}" name="posting_rules_background"
                        autocomplete="image">
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('posting_rules_body') }}</label>
                <div class="row">
                    <textarea id="rules" class="form-control" name="posting_rules_body"
                        placeholder="{{ __('write_the_answer') }}">{{ $rules }}</textarea>
                    @error('posting_rules_body')
                    <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 offset-1 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_posting_rules_setting') }}
            </button>
        </div>
    </div>
</form>
