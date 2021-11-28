Hi{{ $receiver->name ? ' '.$receiver->name : '' }}, 

Your password has been reset successfully. You can now login to your Dashboard 
of {{ env('FRONTEND_LOGIN_URL') }}. 

Account Details: 

<< Name: {{ $receiver->name }} >> 

<< Email: {{ $receiver->email }} >>  

<< Sign-In Link: {{ env('FRONTEND_LOGIN_URL') }} >> 


If you're having trouble clicking the signin button, copy and paste the URL below into your web browser. 

Thanks, 
{{ env('FRONTEND_APP_NAME') }} Support

