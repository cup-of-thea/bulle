<x-layout>
    @php /** @var App\Domain\ValueObjects\Post $post */ @endphp
    <div class="bg-white px-6 py-32 lg:px-8">
        <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">
            <div class="flex flex-wrap items-center gap-x-4 text-xs">
                @if($post->edition?->slug)
                    <a href="{{ route('editions.show', $post->edition->slug) }}"
                       class="font-semibold leading-7 text-indigo-600 hover:text-indigo-800 flex gap-x-2">
                        <x-iconoir-journal-page/>
                        <p>
                            {{ $post->edition->title }}
                        </p>
                    </a>
                @endif
                <time datetime="{{ $post->date->format('Y-m-d') }}" class="text-gray-500">
                    {{ $post->date->isoFormat('LL') }}
                </time>
                @if($post->category?->slug)
                    <a href="{{ route('categories.show', $post->category->slug) }}"
                       class="font-semibold leading-7 text-indigo-600 hover:text-indigo-800">
                        {{ $post->category->title }}
                    </a>
                @endif
                @if($post->tags->isNotEmpty())
                    @foreach($post->tags as $tag)
                        <a href="{{ route('tags.show', $tag->slug) }}"
                           class="font-semibold leading-7 text-red-600 hover:text-red-800">
                            #{{ $tag->title }}
                        </a>
                    @endforeach
                @endif
            </div>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                {{ $post->title }}
            </h1>
            <p class="mt-6 text-xl leading-8">
                {{ $post->description }}
            </p>
            <div class="mt-10 max-w-2xl prose">
                {!! $post->content !!}
            </div>
        </div>
    </div>

    <div class="bg-white py-32">
        <div class="mx-auto max-w-3xl px-6 text-center lg:px-8">
            <div class="mx-auto max-w-2xl">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Auteur·rice·x·s</h2>
            </div>
            <ul role="list"
                class="mx-auto mt-20 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @php /** @var App\Domain\ValueObjects\PostItemAuthor $author */ @endphp
                @foreach($post->authors as $author)
                    <li>
                        <a href="{{ route('authors.show', $author->slug) }}">
                            <img class="mx-auto h-56 w-56 rounded-full object-cover bg-gray-50"
                                 src="{{ $author->image() }}"
                                 alt="{{ $author->name }}">
                            <h3 class="mt-6 text-base font-semibold leading-7 tracking-tight text-gray-900">
                                {{ $author->name }}
                            </h3>
                            <p class="text-sm leading-6 text-gray-600">
                                {{ $author->title() }}
                            </p>
                        </a>

                        <ul role="list" class="mt-6 flex justify-center flex-wrap gap-6">
                            @if($author->twitter())
                                <li>
                                    <a href="{{ $author->twitter() }}" class="text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Twitter</span>
                                        <x-iconoir-twitter class="h-6 w-6"/>
                                    </a>
                                </li>
                            @endif
                            @if($author->linkedin())
                                <li>
                                    <a href="{{ $author->linkedin() }}" class="text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">LinkedIn</span>
                                        <x-iconoir-linkedin class="h-6 w-6"/>
                                    </a>
                                </li>
                            @endif
                            @if($author->github())
                                <li>
                                    <a href="{{ $author->github() }}" class="text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">GitHub</span>
                                        <x-iconoir-github class="h-6 w-6"/>
                                    </a>
                                </li>
                            @endif
                            @if($author->mastodon())
                                <li>
                                    <a href="{{ $author->mastodon() }}" class="text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Mastodon</span>
                                        <x-iconoir-mastodon class="h-6 w-6"/>
                                    </a>
                                </li>
                            @endif
                            @if($author->threads())
                                <li>
                                    <a href="{{ $author->threads() }}" class="text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Threads</span>
                                        <x-iconoir-threads class="h-6 w-6"/>
                                    </a>
                                </li>
                            @endif
                            @if($author->tiktok())
                                <li>
                                    <a href="{{ $author->tiktok() }}" class="text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">TikTok</span>
                                        <x-iconoir-tiktok class="h-6 w-6"/>
                                    </a>
                                </li>
                            @endif
                            @if($author->instagram())
                                <li>
                                    <a href="{{ $author->instagram() }}" class="text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Instagram</span>
                                        <x-iconoir-instagram class="h-6 w-6"/>
                                    </a>
                                </li>
                            @endif
                            @if($author->youtube())
                                <li>
                                    <a href="{{ $author->youtube() }}" class="text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">YouTube</span>
                                        <x-iconoir-youtube class="h-6 w-6"/>
                                    </a>
                                </li>
                            @endif
                            @if($author->website())
                                <li>
                                    <a href="{{ $author->website() }}" class="text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Site web</span>
                                        <x-iconoir-globe class="h-6 w-6"/>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</x-layout>