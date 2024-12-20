<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Tags</h2>
            <x-taxonomies-nav/>
            <div class="mt-10 space-y-16 border-t border-gray-200 pt-10 sm:pt-0">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($this->tags as $tag)
                        <li class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4 py-5 sm:flex-nowrap">
                            <div>
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    <a href="{{ route('tags.show', $tag->slug) }}" class="hover:underline">
                                        #{{ $tag->title }}
                                    </a>
                                </p>
                                <x-last-post :post="$tag->lastPost"/>
                            </div>
                            <dl class="flex w-full flex-none justify-between gap-x-8 sm:w-auto">
                                <div class="flex -space-x-0.5">
                                    <dt class="sr-only">Auteur·rice·x·s</dt>
                                    @foreach($tag->authors as $author)
                                        <dd>
                                            <img class="h-6 w-6 rounded-full bg-gray-50 ring-2 ring-white"
                                                 src="{{ $author->avatar }}" alt="{{ $author->name }}">
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
