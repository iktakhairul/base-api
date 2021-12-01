@component('mail::message')
Hi{{ $receiverName ? ' '.$receiverName : '' }},

Thank you for registering in {{ env('APP_NAME') }}. Your account needs approval
from the administrator before you can login to the Dashboard.

You will get notified as soon the account gets approved.

Please contact us if you have any questions.

Thanks,

{{ env('APP_NAME') }} Support
@endcomponent
