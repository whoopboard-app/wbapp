@component('mail::message')
# Hello {{ ucfirst($name) }}

Thank you for subscribing!  
Please confirm your subscription by clicking the button below:

@component('mail::button', ['url' => $confirmationUrl])
Confirm Subscription
@endcomponent

If you no longer wish to receive these emails, you can unsubscribe anytime:

@component('mail::button', ['url' => $unsubscribeUrl, 'color' => 'error'])
Unsubscribe
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
