<div class="mt-10 border-t border-gray-200 pt-10">
    <h3 class="text-sm font-medium text-gray-900">{{ $title }}</h3>
    <div class="prose prose-sm mt-4 text-gray-500">
        <ul role="list">
            @foreach($elements as $element)
                <li>
                    <a href="{{ route('editions.show', $element->slug) }}"
                       class="text-indigo-600 hover:text-indigo-500">
                        {{ $element->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>