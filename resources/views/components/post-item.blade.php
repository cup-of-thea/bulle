@props(['post'])

<article class="flex max-w-full flex-col items-start justify-between pb-6 border-b">
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
    <div class="group relative">
        <div class="flex items-center mt-3 gap-x-6">
            @foreach($post->authors as $author)
                <a href="{{ route('authors.show', $author->slug) }}">
                    <img class="h-10 w-10 rounded-full bg-gray-50 object-cover"
                         src="{{ $author->avatar }}"
                         alt="{{ $author->slug }}">
                </a>
            @endforeach
            <h3 class="text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                <a href="{{ route('posts.show', $post->slug) }}">
                    <span class="absolute inset-0"></span>
                    {{ $post->title }}
                </a>
            </h3>
        </div>
        @if($post->description)
            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                {{ $post->description }}
            </p>
        @endif
    </div>
</article>
