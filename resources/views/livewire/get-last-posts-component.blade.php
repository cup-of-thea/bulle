<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Derniers articles</h2>
            <p class="my-4 text-lg leading-8 text-gray-600">
                lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
            <div class="flex gap-x-12">
                <a href="{{ route('categories.index') }}" class="font-semibold leading-6 text-gray-900">
                    Catégories
                </a>
                <a href="{{ route('tags.index') }}" class="font-semibold leading-6 text-gray-900">
                    Tags
                </a>
                <a href="{{ route('authors.index') }}" class="font-semibold leading-6 text-gray-900">
                    Auteur·rice·x·s
                </a>
            </div>
            <div class="mt-10 space-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16">
                @foreach($this->posts as $post)
                    <x-post-item :post="$post" />
                @endforeach
            </div>
        </div>
    </div>
</div>

