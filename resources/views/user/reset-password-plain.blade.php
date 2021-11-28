Hi{{ $receiverName ? ' '.$receiverName : '' }}, 
you recently requested to reset your password for your {{ env('FRONTEND_APP_NAME') }} account. Open the link below to reset it. 

<< {{ env('FRONTEND_RESET_PASSWORD_URL').'/'.$passwordResetToken }} >> 

If you did not request a password reset, please ignore this email or reply to let us know. This password reset is only valid for the next 30 minutes. 

If you're having trouble clicking the password reset button, copy and paste the URL below into your web browser. 

<< {{ env('FRONTEND_RESET_PASSWORD_URL').'/'.$passwordResetToken }} >> 

Thanks, 
{{ env('FRONTEND_APP_NAME') }} Support
