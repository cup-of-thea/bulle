<x-layout>
    <div class="bg-white py-8">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl">
                <div class="flex gap-x-12">
                    <a href="{{ route('categories.index') }}" class="text-sm font-semibold leading-6 text-gray-900">
                        Catégories
                    </a>
                    <a href="{{ route('tags.index') }}" class="text-sm font-semibold leading-6 text-gray-900">
                        Tags
                    </a>
                </div>
            </div>
        </div>
    </div>

    <livewire:last-posts />
</x-layout>
