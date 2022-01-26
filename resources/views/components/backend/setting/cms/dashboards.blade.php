<form class="form-horizontal" action="{{ route('admin.dashboard.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row justify-content-between">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('dashboard_overview_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->dashboard_overview_background_path) }}" name="dashboard_overview_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('dashboard_post_ads_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->dashboard_post_ads_background_path) }}" name="dashboard_post_ads_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('dashboard_my_ads_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->dashboard_my_ads_background_path) }}" name="dashboard_my_ads_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-between">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('dashboard_favorite_ads_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->dashboard_favorite_ads_background_path) }}" name="dashboard_favorite_ads_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('dashboard_messenger_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->dashboard_messenger_background_path) }}" name="dashboard_messenger_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('dashboard_plan_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->dashboard_plan_background_path) }}" name="dashboard_plan_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class=" col-md-3">
            <div class="form-group">
                <label>{{ __('dashboard_account_setting_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->dashboard_account_setting_background_path) }}" name="dashboard_account_setting_background"
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

