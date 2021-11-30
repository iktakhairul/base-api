@component('mail::message')
Hi{{ $receiverName ? ' '.$receiverName : '' }},

Your password has been reset successfully. You can now login to your Dashboard
of [{{ env('APP_NAME') }}]({{ env('APP_URL') }}).

@component('mail::panel')
Account Details:

Name: {{ $receiverName }}

Email: {{ $receiverEmail }}

Sign-In Link:  @component('mail::button', ['url' => env('APP_URL'), 'color' => 'success'])
Singing
@endcomponent
@endcomponent


If you're having trouble clicking the signing button, copy and paste the URL below into your web browser.

{{ env('APP_URL') }}

Thanks,

{{ env('APP_NAME') }} Support
@endcomponent
