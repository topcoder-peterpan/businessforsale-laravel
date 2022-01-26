@if ($settings->default_layout)
    @include('layouts.backend.left-nav')
@else
    @include('layouts.backend.top-nav')
@endif
