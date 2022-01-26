<form class="form-horizontal" action="{{ route('admin.pricingplan.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row ">
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('pricing_plan_background') }}</label>
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ asset($cms->pricing_plan_background_path) }}" name="pricing_plan_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('upate_pricing_plan_settings') }}
            </button>
        </div>
    </div>
</form>
