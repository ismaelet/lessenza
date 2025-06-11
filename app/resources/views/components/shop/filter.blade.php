<div class="sidebar__panel filter">
	<label class="filter__header">
		<input
			type="checkbox"
			class="filter-group-checkbox hidden"
			checked
		>

		<h3 class="filter__title">
			{{ $filter['title'] }}
		</h3>

		<div class="filter__ddown-icon icon-box">
			<x-icon-arrow1-down />
		</div>
	</label>

	<div class="filter__ddown">
		<div class="filter__ddown-wrapper">

			@foreach ($filter['list'] as $filterItem)
				<label class="filter-item">
					<input
						type="radio"
						class="hidden"
						name="typeId"
						value="{{ $filterItem->id }}"
						wire:model.live="typeId"
						@checked($typeId == $filterItem->id)
						@click="if ($event.target.value == {{ $typeId ?? 'null' }}) { $wire.set('typeId', null) }"
					>
					<p class="filter-item__name">{{ $filterItem->name }}</p>
				</label>
			@endforeach

		</div>
	</div>
</div>
