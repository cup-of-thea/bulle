@props(['post'])

@if($post)
    <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
        <p>
            <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">
                {{ $post->title }}
            </a>
        </p>
        <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
            <circle cx="1" cy="1" r="1"/>
        </svg>
        <p>
            <time datetime="{{ $post->date->format('Y-m-d') }}">
                {{ $post->date->isoFormat('LL') }}
            </time>
        </p>
    </div>
@endif
