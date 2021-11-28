@component('mail::message')
Hi{{ $receiverName ? ' '.$receiverName : '' }},

You recently requested to reset your password for your {{ env('FRONTEND_APP_NAME') }} account.
@component('mail::panel')
Click the button or open link below to reset it.
@component('mail::button', ['url' => env('FRONTEND_RESET_PASSWORD_URL').'/'.$passwordResetToken , 'color' => 'success'])
Reset Password
@endcomponent
@endcomponent

Or, [Reset password link]({{ env('FRONTEND_RESET_PASSWORD_URL').'/'.$passwordResetToken }})

If you did not request a password reset, please ignore this email or reply to let us know. This password reset is only valid for the next 30 minutes.

If you're having trouble clicking the password reset button, copy and paste the URL below into your web browser.

{{ env('FRONTEND_RESET_PASSWORD_URL').'/'.$passwordResetToken }}

Thanks,

{{ env('FRONTEND_APP_NAME') }} Support
@endcomponent
