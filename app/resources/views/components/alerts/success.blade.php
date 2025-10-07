@props(['message' => null])

@pushOnce('styles')
	<style>
		.success-message {
			box-shadow: 0px 2rem 4rem -1rem hsl(var(--color-success-400-hsl) / .4);
		}
	</style>
@endpushOnce

<p
	{{ $attributes->merge(['class' => 'success-message text-green-400 px-4 py-2 border border-green-400 bg-green-400/10 text-center rounded']) }}
>
	@if (isset($message))
		{{ $message }}
	@else
		{{ $slot }}
	@endif
</p>
