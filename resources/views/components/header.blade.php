<header class="bg-white">
    <nav class="mx-auto flex max-w-7xl sm:items-center justify-between gap-x-6 p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
                <span class="sr-only">La Première Ligne</span>
                <img class="h-8 w-auto" src="/img/icons/logo.png" alt="">
            </a>
        </div>
        <div class="grid gap-8 sm:grid-cols-3">
            <a href="{{ route('blog') }}" class="text-sm font-semibold leading-6 text-gray-900">
                Le Magazine
            </a>
            <a href="{{ route('association') }}" class="text-sm font-semibold leading-6 text-gray-900">
                L'Association
            </a>
            <a href="{{ route('editions.last') }}" class="text-sm font-semibold leading-6 text-gray-900">
                Dernière édition
            </a>
        </div>
    </nav>
</header>
