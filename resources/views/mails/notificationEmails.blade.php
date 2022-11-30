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

There is a new withdrawal request, find details below:

Name:  {{ optional($data['requestedBy'])->name }} <br>
Phone:  {{ $data['name'] }} <br>
Email:  {{ $data['email'] }} <br>
Amount:  {{ $settings->currency_sign. number_format($data['amount']) }} <br>
Reference:  {{ $data['reference'] }} <br>

Kindly login to your account on: <a href="{{ url('/').'/withdrawal' }}">{{ env('APP_NAME') }}</a> to approve or reject this request.

Thank you.
@endif

@if($data['type'] == 'withdrawal-status-change-to-investor')
Dear {{ $data['name'] }},

Your request to withdraw has been {{ strtoUpper($data['status']) }}!

Reference: {{ $data['reference'] }} 

Date requested : {{ $data['date_requested'] }}

Status: <span style="color:{{ $data['status'] == 'accepted' ? 'green' : 'red'}}"> {{ $data['status'] }}</span>

Kindly login to your account on: <a href="{{ url('/').'/withdrawal' }}">{{ env('APP_NAME') }}</a> to view your withdrawal history.

@endif
@if($data['type'] == 'withdrawal-status-change-to-investor')
Dear {{ $data['name'] }},

Your means of identification document has been verified and approved.

You can now proceed with your operation on {{ config('app.name') }}.

Thank you.

@endif

@if($data['type'] == 'id-approval-by-admin')
Dear {{ $data['name'] }},

Your means of identification document has been verified and approved.

You can now proceed with your operation on {{ config('app.name') }}.

Thank you.
@endif

@if($data['type'] == 'upload-means-of-identification')
Dear {{ $data['name'] }},

An investor has just uploaded a means of identification on {{ config('app.name') }}, please find detials below:

Name:  {{ $data['investor_name'] }}

Email:  {{ $data['investor_email'] }}

kindly login to approve.

Thank you
@endif

{{ config('app.name') }}
@endcomponent