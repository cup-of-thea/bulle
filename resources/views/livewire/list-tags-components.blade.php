<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Tags</h2>
            <p class="my-4 text-lg leading-8 text-gray-600">
                lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et
                dolore
                magna aliqua.
            </p>
            <div class="flex gap-x-12">
                <a href="{{ route('categories.index') }}" class="font-semibold leading-6 text-gray-900">
                    Catégories
                </a>
                <a href="{{ route('authors.index') }}" class="font-semibold leading-6 text-gray-900">
                    Auteur·rice·x·s
                </a>
            </div>
            <div class="mt-10 space-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($this->tags as $tag)
                        <li class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4 py-5 sm:flex-nowrap">
                            <div>
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    <a href="{{ route('tags.show', $tag->slug) }}" class="hover:underline">
                                        {{ $tag->title }}
                                    </a>
                                </p>
                                <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                                    <p>
                                        <a href="{{ $tag->lastPostSlug }}" class="hover:underline">
                                            {{ $tag->lastPostTitle }}
                                        </a>
                                    </p>
                                    <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                                        <circle cx="1" cy="1" r="1"/>
                                    </svg>
                                    <p>
                                        <time datetime="{{ $tag->lastPostDate->format('Y-m-d') }}">
                                            {{ $tag->lastPostDate->isoFormat('LL') }}
                                        </time>
                                    </p>
                                </div>
                            </div>
                            <dl class="flex w-full flex-none justify-between gap-x-8 sm:w-auto">
                                <div class="flex -space-x-0.5">
                                    <dt class="sr-only">Auteur·rice·x·s</dt>
                                    @foreach($tag->authors as $author)
                                        <dd>
                                            <img class="h-6 w-6 rounded-full bg-gray-50 ring-2 ring-white"
                                                 src="/img/authors/{{ $author->slug }}.jpg" alt="{{ $author->name }}">
                                        </dd>
                                    @endforeach
                                </div>
                                <div class="flex w-16 gap-x-2.5">
                                    <dd class="leading-6 text-gray-400">
                                        {{ $tag->postsCount }}
                                    </dd>
                                    <dt>
                                        <span class="sr-only">Articles</span>
                                        <x-iconoir-post class="h-6 w-6 text-gray-400"/>
                                    </dt>

                                </div>
                            </dl>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
