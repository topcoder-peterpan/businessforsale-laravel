@component('mail::message')
# Your title goes here.

This is the test mail.

@component('mail::panel', [''])
    Your description goes here.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
