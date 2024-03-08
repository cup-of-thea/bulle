<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Catégories</h2>
            <x-taxonomies-nav/>
            <div class="mt-10 space-y-16 border-t border-gray-200 pt-10 sm:pt-0">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($this->categories as $category)
                        <li class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4 py-5 sm:flex-nowrap">
                            <div>
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    <a href="{{ route('categories.show', $category->slug) }}" class="hover:underline">
                                        {{ $category->title }}
                                    </a>
                                </p>
                                <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                                    <p>
                                        <a href="{{ $category->lastPostSlug }}" class="hover:underline">
                                            {{ $category->lastPostTitle }}
                                        </a>
                                    </p>
                                    <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                                        <circle cx="1" cy="1" r="1"/>
                                    </svg>
                                    <p>
                                        <time datetime="{{ $category->lastPostDate->format('Y-m-d') }}">
                                            {{ $category->lastPostDate->isoFormat('LL') }}
                                        </time>
                                    </p>
                                </div>
                            </div>
                            <dl class="flex w-full flex-none justify-between gap-x-8 sm:w-auto">
                                <div class="flex -space-x-0.5">
                                    <dt class="sr-only">Auteur·rice·x·s</dt>
                                    @foreach($category->authors as $author)
                                        <dd>
                                            <img class="h-6 w-6 rounded-full bg-gray-50 ring-2 ring-white"
                                                 src="{{ $author->image }}" alt="{{ $author->name }}">
                                        </dd>
                                    @endforeach
                                </div>
                                <div class="flex w-16 gap-x-2.5">
                                    <dd class="leading-6 text-gray-400">
                                        {{ $category->postsCount }}
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
