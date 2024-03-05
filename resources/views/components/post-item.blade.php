@props(['post'])

<article class="flex max-w-xl flex-col items-start justify-between">
    <div class="flex items-center gap-x-4 text-xs">
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
        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
            <a href="{{ route('posts.show', $post->slug) }}">
                <span class="absolute inset-0"></span>
                {{ $post->title }}
            </a>
        </h3>
        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
            {{ $post->description }}
        </p>
    </div>
    @foreach($post->authors as $author)
        <a href="{{ route('authors.show', $author->slug) }}" class="mt-6 flex items-center gap-x-6">
            <img class="h-12 w-12 rounded-full bg-gray-50 object-cover"
                 src="{{ $author->image() }}"
                 alt="{{ $author->slug }}">
            <div class="text-base">
                <div class="font-semibold text-gray-900">
                    {{ $author->name }}
                </div>
                <div class="mt-1 text-gray-500">
                    {{ $author->title() }}
                </div>
            </div>
        </a>
    @endforeach
</article>
