<h1>{{ $career->title }}</h1>
<p>{{ $career->location }}</p>
<p>{{ $career->salary }}</p>
<p>{{ $career->type }}</p>
@if ($career->duration)
    <p>{{ $career->duration }}</p>
@endif

@include('page-builder::components', ['components' => $career->components])

@include('nova-careers::partials.apply-button', ['application_url' => $career->application_url])
