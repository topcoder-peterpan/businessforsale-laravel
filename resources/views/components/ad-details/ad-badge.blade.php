<div class="product-item__badge">
    @if ($featured)
    <div class="badge badge--warning">
        <x-svg.check-icon width="24" height="24" stroke="#ffbf00" />
        <div class="badge badge--warning">
            {{ __('website.featured') }}
        </div>
    </div>
    @endif
    @if (hasMemberBadge($customerid))
        <div class="badge badge--danger">
            <span class="icon">
                <x-svg.membership-badge-icon />
            </span>
            {{ __('website.member') }}
        </div>
    @endif
</div>
