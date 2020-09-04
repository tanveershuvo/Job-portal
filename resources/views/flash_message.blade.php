@if (Session::has('message'))
    @php
        $messages = Session::get('message');
    @endphp
    <div class="alert alert-{{ $messages['status'] }}">
        <b>{{ $messages['data'] }}</b>
    </div>
@endif
