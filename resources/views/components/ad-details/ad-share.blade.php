<div class="share-content">
    <h2 class="share-content__title text--body-3">
        <span class="icon">
            <x-svg.share-icon />
        </span>
        {{ __('website.share_ads') }}
    </h2>
    <ul class="share">
        <li class="share__item">
            <a target="_blank"
                href="{{ socialMediaShareLinks('/ad/details/', $slug)['whatsapp'] }}"
                class="social-link social-link--wa share__link">
                <x-svg.whatsapp-icon />
            </a>
        </li>
        <li class="share__item">
            <a target="_blank"
                href="{{ socialMediaShareLinks('/ad/details/', $slug)['facebook'] }}"
                class="social-link social-link--fb share__link">
                <x-svg.facebook-icon fill="#fff" />
            </a>
        </li>
        <li class="share__item">
            <a target="_blank"
                href="{{ socialMediaShareLinks('/ad/details/', $slug)['twitter'] }}"
                class="social-link social-link--tw share__link">
                <x-svg.twitter-icon fill="#fff"/>
            </a>
        </li>
        <li class="share__item">
            <a target="_blank"
                href="{{ socialMediaShareLinks('/ad/details/', $slug)['linkedin'] }}"
                class="social-link social-link--in share__link">
                <x-svg.linkedin-icon />
            </a>
        </li>
        <li class="share__item">
            <a href="{{ socialMediaShareLinks('/ad/details/', $slug)['gmail'] }}"
                class="social-link social-link--p share__link">
                <x-svg.envelope-icon stroke="#ffffff" />
            </a>
        </li>
        <li class="share__item" onclick="copyToClipboard()" style="cursor: pointer" title="Copy to clipboard">
            <a class="social-link social-link--lk share__link">
                <x-svg.link-icon />
            </a>
        </li>
    </ul>
</div>

@push('ad_scripts')
<script>
    function copyToClipboard() {
        let temp = $("<input>");
        $("body").append(temp);
        temp.val(window.location).select();
        document.execCommand("copy");
        temp.remove();
        alert("Copied to clipboard!");
    }
</script>
@endpush
