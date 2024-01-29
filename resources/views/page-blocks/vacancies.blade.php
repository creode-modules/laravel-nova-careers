<h2>{{ __('Our Vacancies') }}</h2>

@foreach ($vacancies as $vacancy)
    <h3><a href="{{ route('careers.show', $vacancy->slug) }}" title="View {{ $vacancy->title }} vacancy">{{ $vacancy->title }}</a></h3>
    <p>{{ $vacancy->meta_description }}</p>
@endforeach
