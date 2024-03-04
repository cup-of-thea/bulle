@props(['post'])

<article class="flex max-w-xl flex-col items-start justify-between">
    <div class="flex items-center gap-x-4 text-xs">
        <time datetime="{{ $post->date->format('Y-m-d') }}" class="text-gray-500">
            {{ $post->date->isoFormat('LL') }}
        </time>
        @if($post->category?->slug)
            <a href="{{ route('categories.show', $post->category->slug) }}"
               class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                {{ $post->category->title }}
            </a>
        @endif
        @if($post->tags->isNotEmpty())
            @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}"
                   class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
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
        <div class="relative mt-8 flex items-center gap-x-4">
            <img src="/img/authors/{{ $author->slug }}.jpg" alt="" class="h-12 w-12 rounded-full bg-gray-50 aspect-square object-cover">
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
