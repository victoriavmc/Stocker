@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4 bg-base-300/10 border-b border-base-content/30">
        <div class="text-2xl text-center font-medium text-base-content">
            {{ $title }}
        </div>
    </div>

    <div class="px-6 py-4 bg-base-300">
        <div class="mt-4 text-sm text-base-content">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-base-300/10 text-end border-t border-base-content/30">
        {{ $footer }}
    </div>
</x-modal>
