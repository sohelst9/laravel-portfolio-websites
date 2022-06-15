@component('mail::message')
    <h3>New Message form {{ $contact_form_data['email'] }}</h3>
    <p>Name: {{ $contact_form_data['name'] }}</p>
    <p>Message: {{ $contact_form_data['message'] }}</p>
@endcomponent
