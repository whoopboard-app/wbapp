@component('mail::message')
@php
use Illuminate\Support\Str;
@endphp
# Hello {{ ucfirst($invite->first_name) }}

You have been invited to join our platform as {{ Str::of($invite->role)->replace('_', ' ')->title() }}.  
Click the button below to complete your registration:

@component('mail::button', ['url' => route('invite.accept', $invite->token)])
Accept Invitation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent