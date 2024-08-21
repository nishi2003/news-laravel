<!-- resources/views/news/show.blade.php -->

<!-- Safely access $value with a default fallback -->
<p>{{ $value ?? 'Default Value' }}</p>

<!-- Alternatively, check if $value is set before displaying -->
@isset($value)
    <p>{{ $value }}</p>
@else
    <p>Default Value</p>
@endisset

<!-- resources/views/news/show.blade.php -->

{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        @if($news)
            <h1>{{ $news->title }}</h1>
            <p>Category: {{ $news->category }}</p>
            <p>{{ $news->description }}</p>
        @else
            <p>News article not found.</p>
        @endif
    </div>
@endsection --}}

