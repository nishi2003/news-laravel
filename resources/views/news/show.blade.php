<!-- resources/views/news/show.blade.php -->

<!-- Safely access $value with a default fallback -->
<p>{{ $value ?? 'Default Value' }}</p>

<!-- Alternatively, check if $value is set before displaying -->
@isset($value)
    <p>{{ $value }}</p>
@else
    <p>Default Value</p>
@endisset
