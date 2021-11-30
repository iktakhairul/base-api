Hi{{ $receiverName ? ' '.$receiverName : '' }},

Your password has been reset successfully. You can now login to your Dashboard
of {{ env('APP_URL').'/login' }}.

Account Details:

<< Name: {{ $receiverName }} >>

<< Email: {{ $receiverEmail }} >>

<< Sign-In Link: {{ env('APP_URL').'/register' }} >>


If you're having trouble clicking the signing button, copy and paste the URL below into your web browser.

Thanks,
{{ env('APP_NAME') }} Support

