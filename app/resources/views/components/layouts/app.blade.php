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

	@if (app()->environment('production'))
		<!-- Google Tag Manager -->
		<script>
			(function(w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({
					'gtm.start': new Date().getTime(),
					event: 'gtm.js'
				});
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != 'dataLayer' ? '&l=' + l : '';
				j.async = true;
				j.src =
					'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, 'script', 'dataLayer', 'GTM-M8V7W24L');
		</script>
		<!-- End Google Tag Manager -->
	@endif
</head>

<body>
	@if (app()->environment('production'))
		<!-- Google Tag Manager (noscript) -->
		<noscript>
			<iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-M8V7W24L"
				height="0"
				width="0"
				style="display:none;visibility:hidden"
			></iframe>
		</noscript>
		<!-- End Google Tag Manager (noscript) -->
	@endif

	{{ $slot }}

	<livewire:scripts />
</body>

</html>
