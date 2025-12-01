<div>
	<label class="checkbox group relative flex w-fit items-center gap-2">
		<input
			type="checkbox"
			name="extra_concentrated"
			class="hidden"
			wire:model.live="extraConcentrated"
			@checked($extraConcentrated)
		>

		<span
			class="group/icon flex h-6 w-6 cursor-pointer rounded-full border border-neutral-300 transition-colors group-has-[:checked]:border-neutral-700"
		>
			<span
				class="bg-primary-400 m-auto h-2 w-2 rounded-full opacity-0 transition-opacity group-hover/icon:opacity-100 group-has-[:checked]:opacity-100"
			></span>
		</span>

		<p class="cursor-pointer text-lg leading-none text-neutral-700">Extra concentrata (€ 5,00 in più)</p>
	</label>
</div>
