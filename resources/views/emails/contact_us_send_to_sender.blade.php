@component('mail::message')
<h3>Hi <b>{{$data['name']}}</b>,</h3>

<p>We have received your message and let us thank you for contacting with us.</p>

Thanks,<br>
{{ get_option('site_name') }}
@endcomponent