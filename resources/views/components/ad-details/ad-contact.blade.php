<div class="product-item__sidebar-item">
    <div class="card-number">
        <div class="number number--hide text--body-2">
            <span class="icon">
                <x-svg.phone-icon width="32" height="32" />
            </span>
            {{ Str::limit($phone, 8,' XXXXXXXX') }}
        </div>
        <div class="number number--show text--body-2">
            <span class="icon">
                <x-svg.phone-icon width="32" height="32" />
            </span>
            {{ $phone }}
        </div>

        <span class="text--body-4 message">{{ __('website.reveal_phone_number') }}.</span>
    </div>

    @if (auth('customer')->check() && auth('customer')->user()->username !== $name )
        <form action="{{ route('frontend.message.store', $name) }}" method="POST"
            id="sendMessageForm">
            @csrf
            <input type="hidden" value="." name="body">
            <button type="submit" class="btn w-100">
                <span class="icon--left">
                    <x-svg.message-icon width="24" height="24" stroke="white" strokeWidth="1.6" />
                </span>
                {{ __('website.send_message') }}
            </button>
        </form>
    @endif
    @if(!auth('customer')->check())
        <a href="{{ route('customer.login') }}" onclick="return confirm('You need to login to send message. Do you want to login?')" class="btn w-100">
            <span class="icon--left">
                <x-svg.message-icon width="24" height="24" stroke="white" strokeWidth="1.6" />
            </span>
            {{ __('website.send_message') }}
        </a>
    @endif
</div>
