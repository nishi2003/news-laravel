<!-- resources/views/emails/news_added.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>New News Added</title>
</head>
<body>
    <h1>{{ $news->title }}</h1>
    <p>{{ $news->description }}</p>
    <p>Author: {{ $news->author }}</p>
</body>
</html>


{{--
@component('mail::message')
# New News Added

A new news article titled **{{ $news->title }}** has been added.

@component('mail::button', ['url' => url('/news/' . $news->id)])
View News
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}
