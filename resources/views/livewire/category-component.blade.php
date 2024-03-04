<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl">
            <h2 class="text-3xl mb-16 font-bold tracking-tight text-gray-900 sm:text-4xl">
                {{ $category->title }}
            </h2>
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


