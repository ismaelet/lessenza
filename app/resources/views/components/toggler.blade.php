@props(['label', 'checked' => false])

<label class="group flex cursor-pointer items-center gap-2">
    <input
        {{ $attributes->merge(['type' => 'checkbox', 'class' => 'hidden']) }}
        @checked($checked) />

    <span class="group-has-checked:bg-primary w-12 rounded-full bg-gray-300 p-1 transition-colors">
        <span
            class="group-has-checked:left-full group-has-checked:-translate-x-full relative left-0 block aspect-square w-4 origin-right translate-x-0 rounded-full bg-white transition-all"></span>
    </span>

    <p>{{ $label }}</p>
</label>