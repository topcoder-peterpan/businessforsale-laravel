<form class="form-horizontal" action="{{ route('admin.home.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row justify-content-between">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index1_main_banner') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index1_main_banner_path }}" name="index1_main_banner"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index1_counter_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index1_counter_background_path }}" name="index1_counter_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index1_mobile_app_banner') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index1_mobile_app_banner_path }}" name="index1_mobile_app_banner"
                        autocomplete="image">
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-between">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index2_search_filter_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index2_search_filter_background_path }}" name="index2_search_filter_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index2_get_membership_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index2_get_membership_background_path }}" name="index2_get_membership_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('index3_search_filter_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->index3_search_filter_background_path }}" name="index3_search_filter_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('upate_home_settings') }}
            </button>
        </div>
    </div>
</form>

