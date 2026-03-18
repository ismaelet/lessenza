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

	<!-- Meta Pixel Code -->
	<script>
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '916622974342238');
		fbq('track', 'PageView');
	</script>
	<noscript><img
			height="1"
			width="1"
			style="display:none"
			src="https://www.facebook.com/tr?id=916622974342238&ev=PageView&noscript=1"
		/></noscript>
	<!-- End Meta Pixel Code -->
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

	{{-- Meta Pixel in browser events --}}
	<script>
		document.addEventListener('livewire:init', () => {

			// Initiate checkout event listener
			Livewire.on('meta-initiate-checkout', (data) => {
				if (typeof fbq !== 'undefined') {
					fbq('track', 'InitiateCheckout', {
						content_ids: [data.cart_id],
					});
				}
			});

			// Add to cart event listener
			Livewire.on('meta-add-to-cart', (data) => {
				if (typeof fbq !== 'undefined') {
					fbq('track', 'AddToCart', {
						content_ids: [data.product_id],
						content_name: data.name,
						value: data.price * data.quantity,
						currency: 'EUR'
					});
				}
			});

			// Search event listener
			Livewire.on('meta-search', (event) => {
				if (typeof fbq !== 'undefined' && event.detail.query) {
					fbq('track', 'Search', {
						search_string: event.detail.query
					});
				}
			});
		});
	</script>

	{{-- Meta Pixel flash events --}}

	{{-- Add payment info event --}}
	@if (session('meta_add_payment_info'))
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				if (typeof fbq !== 'undefined') {
					const metaData = @json(session('meta_add_payment_info'));

					fbq('track', 'AddPaymentInfo', {
						payment_method: metaData.payment_type
					});
				}
			});
		</script>
	@endif

	{{-- Purchase event --}}
	@if (session('meta_purchase'))
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				if (typeof fbq !== 'undefined') {
					const data = @json(session('meta_purchase'));

					fbq('track', 'Purchase', {
						value: data.value,
						currency: data.currency,
						content_ids: data.content_ids,
						content_type: 'product',
						num_items: data.num_items
					});
				}
			});
		</script>
	@endif

	{{-- Complete registration event --}}
	@if (session('meta_complete_registration'))
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				if (typeof fbq !== 'undefined') {
					fbq('track', 'CompleteRegistration');
				}
			});
		</script>
	@endif

	{{-- Contact event --}}
	@if (session('meta_contact'))
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				if (typeof fbq !== 'undefined') {
					fbq('track', 'Contact');
				}
			});
		</script>
	@endif
</body>

</html>
