@component('mail::message')
# Hello {{ ucfirst($name) }}

Thank you for subscribing!  
Please confirm your subscription by clicking the button below:

@component('mail::button', ['url' => $confirmationUrl])
Confirm Subscription
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
