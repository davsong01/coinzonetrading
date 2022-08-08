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


@endif
{{ config('app.name') }}
@endcomponent