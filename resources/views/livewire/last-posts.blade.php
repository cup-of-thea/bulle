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
            </div>
            <div class="mt-10 space-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16">
                @foreach($this->posts as $post)
                    <article class="flex max-w-xl flex-col items-start justify-between">
                        <div class="flex items-center gap-x-4 text-xs">
                            <time datetime="{{ $post->date->format('Y-m-d') }}" class="text-gray-500">
                                {{ $post->date->format('LLL') }}
                            </time>
                            @if($post->category?->slug)
                                <a href="{{ route('categories.show', $post->category->slug) }}"
                                   class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                                    {{ $post->category->title }}
                                </a>
                            @endif
                        </div>
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="{{ route('posts.show', $post->slug) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">Illo sint voluptas. Error voluptates culpa eligendi. Hic vel totam vitae illo. Non aliquid explicabo necessitatibus unde. Sed exercitationem placeat consectetur nulla deserunt vel iusto corrupti dicta laboris incididunt.</p>
                        </div>
                        @foreach($post->authors as $author)
                            <div class="relative mt-8 flex items-center gap-x-4">
                                <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-10 w-10 rounded-full bg-gray-50">
                                <div class="text-sm leading-6">
                                    <p class="font-semibold text-gray-900">
                                        <a href="{{ route('authors.show', $author->slug) }}">
                                            <span class="absolute inset-0"></span>
                                            {{ $author->name }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </article>
                @endforeach
            </div>
        </div>
    </div>
</div>

