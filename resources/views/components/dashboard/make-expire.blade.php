<form action="{{ route('frontend.myad.expire', $ad) }}" method="post" class="edit-dropdown__link">
    @csrf
    @method('PUT')
    <button onclick="return confirm('Are you sure you want to expire this item?');" type="submit" class="d-flex align-items-center">
        <span class="icon">
            <x-svg.cross-icon />
        </span>
        <h5 class="text--body-4">{{ __('website.mark_as_expire') }}</h5>
    </button>
</form>
