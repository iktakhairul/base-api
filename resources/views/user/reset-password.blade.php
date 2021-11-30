@component('mail::message')
Hi{{ $receiverName ? ' '.$receiverName : '' }},

You recently requested to reset your password for your {{ env('APP_NAME') }} account.
@component('mail::panel')
Click the button or open link below to reset it.
@component('mail::button', ['url' => env('APP_URL').'/'.$passwordResetToken , 'color' => 'success'])
Reset Password
@endcomponent
@endcomponent

Or, [Reset password link]({{ env('APP_URL').'/'.$passwordResetToken }})

If you did not request a password reset, please ignore this email or reply to let us know. This password reset is only valid for the next 30 minutes.

If you're having trouble clicking the password reset button, copy and paste the URL below into your web browser.

{{ env('APP_URL').'/'.$passwordResetToken }}

Thanks,

{{ env('APP_NAME') }} Support
@endcomponent
