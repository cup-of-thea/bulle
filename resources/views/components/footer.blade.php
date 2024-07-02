@php use Carbon\Carbon; @endphp
<footer class="bg-white">
    <div class="mx-auto max-w-7xl overflow-hidden px-6 py-20 sm:py-24 lg:px-8">
        <nav class="-mb-6 columns-2 sm:flex sm:justify-center sm:space-x-12" aria-label="Footer">
            <div class="pb-6">
                <a href="{{ route('association') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">
                    L'Association
                </a>
            </div>
            <div class="pb-6">
                <a href="{{ route('authors.index') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">
                    Auteur·rice·x·s
                </a>
            </div>
            <div class="pb-6">
                <a href="{{ route('legals') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">
                    Mentions légales
                </a>
            </div>
            <div class="pb-6">
                <a href="mailto:contact@lapremiereligne.fr" class="text-sm leading-6 text-gray-600 hover:text-gray-900">
                    Nous contacter
                </a>
            </div>
        </nav>
        <div class="mt-10 flex justify-center space-x-10">
            <a href="https://bsky.app/profile/lapremiereligne.bsky.social" target="_blank"
               class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">BlueSky</span>
                <x-tabler-brand-bluesky class="h-6 w-6"/>
            </a>
            <a href="https://hachyderm.io/@lapremiereligne" target="_blank" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Mastodon</span>
                <x-iconoir-mastodon class="h-6 w-6"/>
            </a>
            <a href="https://github.com/cup-of-thea/bulle" target="_blank" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">GitHub</span>
                <x-iconoir-github class="h-6 w-6"/>
            </a>
        </div>
        <p class="mt-10 text-center text-xs leading-5 text-gray-500">
            &copy; {{ Carbon::now()->year }} La Première Ligne
        </p>
    </div>
</footer>