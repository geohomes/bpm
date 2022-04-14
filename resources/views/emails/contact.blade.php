@component('mail::message', ['contact' => $contact])
<h1>{{ $contact['fullname'] }} Contacted.</h1>
<h3>Phone: {{ $contact['phone'] }}</h3>
<h3>Email: {{ $contact['email'] }} ({{ $contact['designation'] }})</h3>
<div>Message: {{ $contact['message'] }}</div>
@endcomponent
