@component('mail::message')
@if($data['type'] == 'registration')
Dear {{ $data['name'] }},

Welcome to CoinZone
@endif

{{ config('app.name') }}
@endcomponent