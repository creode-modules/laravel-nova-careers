@php
    $apply_url = $application_url ? $application_url : config('nova-careers.application_email');
@endphp

<a href="mailto:{{ $apply_url }}">Apply</a>
