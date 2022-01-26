<form action="{{ route('frontend.delete.myad',$ad->id) }}" method="post" class="edit-dropdown__link">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');" class="d-flex align-items-center">
        <span class="icon">
            <x-svg.delete-icon />
        </span>
        <h5 class="text--body-4">{{ __('website.delete_ads') }}</h5>
    </button>
</form>
