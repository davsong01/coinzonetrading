@component('mail::message')
@if($data['type'] == 'registration')
Dear {{ $data['name'] }},

Welcome to CoinZone
@endif

@if($data['type'] == 'contact-mail-to-admin')
Dear {{ $data['name'] }},

Please find below the contact form details:

Name: {{ $data['messageDetails']['name'] }}

Email: {{ $data['messageDetails']['email'] }}

Phone: {{ $data['messageDetails']['phone'] }}

Email: {!! $data['messageDetails']['message'] !!}

@endif

@if($data['type'] == 'withdrawal-notification-to-admin')
Dear {{ $data['name'] }},

There is a new withdrawal request from {{ optional($data['requestedBy'])->name }},
log into your account to view the request.
@endif

@if($data['type'] == 'withdrawal-status-change-to-investor')
Dear {{ $data['name'] }},

The status of your withdrawal request was recently changed,
log into your account to see the update.
@endif

{{ config('app.name') }}
@endcomponent