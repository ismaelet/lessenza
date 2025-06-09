@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'regular',
    'color' => 'default',
])

@php
	$classes = 'button transition-colors';
@endphp

@pushOnce('styles')
	<style>
		.button {
			--_padding-block: min(2.2em, 6vw);
			min-width: 16rem;
			padding-block: 2rem;
			border-radius: var(--radius-md);
			font-family: var(--font-heading);
			font-size: var(--text-200);
			letter-spacing: 0.2em;
			text-align: center;
			text-transform: uppercase;

			/* Primary button */
			&[data-variant="primary"] {
				padding-block: var(--_padding-block);
				padding-inline: calc(var(--_padding-block) * 1.5);
				background-color: var(--color-primary-400);
				color: #fff;

				/* Primary button: Hover state */
				&:hover {
					background-color: var(--color-primary-300);
				}
			}

			/* Secondary button */
			&[data-variant="secondary"] {
				padding-block: calc(1em - var(--border-width));
				border: var(--border-width) solid var(--color-neutral-400);
				color: var(--color-neutral-700);

				/* Secondary button: Dark color scheme */
				[data-color-scheme="dark"] &,
				[data-local-color-scheme="dark"] & {
					border-color: var(--color-neutral-400);
				}

				/* Secondary button: Error color */
				&[data-color="error"] {
					border-color: var(--color-error-400);
					color: var(--color-error-400);

					/* Secondary button: Error color - hover state */
					&:hover {
						color: var(--color-error-500);
						border-color: var(--color-error-500);
					}
				}

				/* Secondary button: Hover state */
				&:hover {
					color: var(--color-neutral-700);
					border-color: var(--color-neutral-700);
				}
			}

			/* Sizes */
			&[data-size="small"] {
				min-width: 8rem;
				font-size: var(--font-size-300);
			}

			/* If contains icons */
			:where(&:has(svg)) {
				display: flex;
				align-items: center;
				gap: 0.5em;
			}
		}
	</style>
@endPushOnce

@if ($href)
	<a
		href="{{ $href }}"
		{{ $attributes->class($classes) }}"
		data-variant="{{ $variant }}"
		data-size="{{ $size }}"
		data-color="{{ $color }}"
	>{{ $slot }}</a>
@else
	<button
		type="{{ $type }}"
		{{ $attributes->class($classes) }}"
		data-variant="{{ $variant }}"
		data-size="{{ $size }}"
		data-color="{{ $color }}"
	>{{ $slot }}</button>
@endif
