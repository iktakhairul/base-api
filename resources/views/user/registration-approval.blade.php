@component('mail::message')
Hi{{ $receiver->name ? ' '.$receiver->name : '' }},

Congratulations! Your account has been approved. You can now login to your Dashboard 
of [{{ env('FRONTEND_APP_NAME') }}]({{ env('FRONTEND_LOGIN_URL') }}).

@component('mail::panel')
Account Details:

Name: {{ $receiver->name }}

Email: {{ $receiver->email }}

Password : {{ $password }}

Sign-In Link:  @component('mail::button', ['url' => env('FRONTEND_LOGIN_URL'), 'color' => 'success'])
Singin
@endcomponent
@endcomponent


If you're having trouble clicking the signin button, copy and paste the URL below into your web browser. 

{{ env('FRONTEND_LOGIN_URL') }}

@component('mail::panel')
    We recommend to change your password after login due to security issue.
@endcomponent

Thanks,

{{ env('FRONTEND_APP_NAME') }} Support
@endcomponent
