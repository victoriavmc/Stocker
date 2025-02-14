<x-mary-button
    {{ $attributes->merge(['type' => 'button', 'class' => 'btn-primary bg-base-content border-base-content text-base-100 hover:bg-base-content/80 hover:border-base-content/80']) }}>
    {{ $label }}
</x-mary-button>
