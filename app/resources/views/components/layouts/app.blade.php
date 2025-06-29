@props([
    'title' => null,
    'description' => null,
    'thumbnail' => null,
    'colorScheme' => null,
])

@php
	$appName = config('app.name');
	$appDescription = config('custom.meta_data.description');
	$description = $description ?: $appDescription;
	$thumbnail = $thumbnail ?: Vite::image('thumbnail.jpg');

	$title = $title ? $title . ' | ' . $appName : $appName . ' | ' . config('custom.meta_data.short_description');
@endphp

<!DOCTYPE html>
<html
	class=""
	lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<head>
	<meta charset="utf-8">
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1"
	>
	<meta
		name="description"
		content="{{ $description }}"
	>
	<meta
		property="og:image"
		content="{{ $thumbnail }}"
	>
	<link
		rel="icon"
		href="{{ asset('favicon.ico') }}"
	>
	<title>
		{{ $title }}
	</title>

	<livewire:styles />

	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@stack('styles')
	@stack('scripts')

</head>

<body>
	{{ $slot }}

	<livewire:scripts />
</body>

</html>
