@component('mail::message')

A contact query has been placed by {{$data['name']}}

<b>Name :</b> {{$data['name']}}

<b>Subject :</b> {{$data['subject']}}

<b>Message :</b> {{$data['message']}}

Thanks,<br>
{{ get_option('site_name') }}
@endcomponent