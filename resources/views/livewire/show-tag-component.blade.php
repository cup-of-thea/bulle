<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                #{{ $tag->title }}
            </h2>
            <x-taxonomies-nav/>
            <div class="mt-10 space-y-16 border-t border-gray-200 pt-4">
                @foreach($this->posts as $post)
                    <x-post-item :post="$post"/>
                @endforeach
            </div>
        </div>
    </div>
</div>


