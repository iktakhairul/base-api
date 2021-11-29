@component('mail::message')
Hi{{ $receiver->name ? ' '.$receiver->name : '' }},

Your password has been reset successfully. You can now login to your Dashboard
of [{{ env('FRONTEND_APP_NAME') }}]({{ env('FRONTEND_LOGIN_URL') }}).

@component('mail::panel')
Account Details:

Name: {{ $receiver->name }}

Email: {{ $receiver->email }}

Sign-In Link:  @component('mail::button', ['url' => env('FRONTEND_LOGIN_URL'), 'color' => 'success'])
Singing
@endcomponent
@endcomponent


If you're having trouble clicking the signing button, copy and paste the URL below into your web browser.

{{ env('FRONTEND_LOGIN_URL') }}

Thanks,

{{ env('FRONTEND_APP_NAME') }} Support
@endcomponent
