@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/user-dashboard-index.css') }}"
	>
@endpushOnce

<x-layouts.user-dashboard
	:$title
	:$location
>

	<div class="page-block grid grid-cols-1 gap-12">
		<section>
			<x-user-dashboard.heading icon="orders">
				Ordini
			</x-user-dashboard.heading>

			<div class="mt-4">
				<x-shop.order-list :$orders />
			</div>
		</section>
	</div>

</x-layouts.user-dashboard>
