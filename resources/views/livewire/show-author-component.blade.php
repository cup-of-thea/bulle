<div class="bg-white">
    @php /** @var App\Domain\ValueObjects\Author $author */ @endphp
    <div class="mx-auto px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <div class="lg:grid lg:grid-cols-7 lg:grid-rows-1 lg:gap-x-8 lg:gap-y-10 xl:gap-x-16">
            <!-- Author image -->
            <div class="lg:col-span-4 lg:row-end-1">
                <div class="aspect-h-3 aspect-w-4 overflow-hidden rounded-lg bg-gray-100">
                    <img src="{{ $author->image }}" alt="" class="object-cover object-center">
                </div>
            </div>

            <!-- Author details -->
            <div class="mx-auto mt-14 max-w-2xl sm:mt-16 lg:col-span-3 lg:row-span-2 lg:row-end-2 lg:mt-0 lg:max-w-none">
                <div class="flex flex-col-reverse">
                    <div class="mt-4">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            {{ $author->name }}
                        </h1>

                        <h2 id="information-heading" class="sr-only">Product information</h2>
                        <p class="mt-2 text-sm text-gray-500">
                            {{ $author->title }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">
                            {{ $this->posts->count() == 1 ? '1 article publié' : $this->posts->count() . ' articles publiés'}}
                        </p>
                    </div>
                </div>

                @if($author->bio)
                    <p class="mt-6 text-gray-500">
                        {{ $author->bio }}
                    </p>
                @endif

                @if($author->links->isNotEmpty())
                    <div class="mt-10 border-t border-gray-200 pt-10">
                        <h3 class="text-sm font-medium text-gray-900">Liens</h3>
                        <div class="mt-4 text-gray-500">
                            <ul role="list">
                                @foreach($author->links as $icon => $link)
                                    <li class="my-3">
                                        <a href="{{ $link }}" class="flex items-center gap-2">
                                            <p>
                                                {{ svg("iconoir-$icon", 'w-6 h-6') }}
                                            </p>
                                            <p class="text-indigo-600 hover:text-indigo-500">
                                                {{ $link }}
                                            </p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if($this->editions->isNotEmpty())
                    <x-authors.relations :resource="'editions'" :title="'Éditions'" :elements="$this->editions"/>
                @endif

                @if($this->categories->isNotEmpty())
                    <x-authors.relations :resource="'categories'" :title="'Catégories'" :elements="$this->categories"/>
                @endif

                @if($this->tags->isNotEmpty())
                    <x-authors.relations :resource="'tags'" :title="'Tags'" :elements="$this->tags"/>
                @endif

                @if($this->coAuthors->isNotEmpty())
                    <x-authors.co-authors :resource="'authors'"
                                          :title="'Co-auteur·ice·s·x'"
                                          :elements="$this->coAuthors"/>
                @endif

            </div>

            <div class="mx-auto mt-16 w-full max-w-2xl lg:col-span-4 lg:mt-0 lg:max-w-none">
                <div>
                    <div class="my-10 border-b border-gray-200 pb-10">
                        <h3 class="font-medium text-gray-900">Articles</h3>
                    </div>
                    @foreach($this->posts as $post)
                        <x-post-item :post="$post"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



