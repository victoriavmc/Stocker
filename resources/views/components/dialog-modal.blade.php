@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4 bg-base-300 border-b border-base-content/30">
        <div class="text-2xl text-center font-medium text-base-content">
            {{ $title }}
        </div>
    </div>

    <div class="px-6 py-4 bg-base-300">
        <div class="my-4 text-sm text-base-content">
            {{ $content }}
        </div>
    </div>

    <div class="pb-4 bg-base-300">
        <div class="h-[2px] border border-t-base-100">
            <progress class="progress progress-primary hidden h-[1px]" wire:loading.class="!h-[2px] !block"></progress>
        </div>
        <div class="px-6 flex flex-row justify-end gap-2 text-end mt-4">
            {{ $footer }}
        </div>
    </div>
</x-modal>
