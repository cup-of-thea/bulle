<header class="bg-white">
    <nav class="mx-auto flex max-w-7xl items-center justify-between gap-x-6 p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
                <span class="sr-only">Bulle</span>
                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
            </a>
        </div>
        <div class="flex gap-x-12">
            <a href="{{ route('blog') }}" class="text-sm font-semibold leading-6 text-gray-900">
                Le Magazine
            </a>
            <a href="{{ route('association') }}" class="text-sm font-semibold leading-6 text-gray-900">
                L'Association
            </a>
        </div>
    </nav>
</header>
