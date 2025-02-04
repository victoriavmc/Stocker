<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-xs sm:btn-sm md:btn-md lg:btn-lg']) }}>
    {{ $slot }}
</button>