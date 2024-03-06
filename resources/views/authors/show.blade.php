<x-layout>
    <x-slot name="metaTitle">{{ $author->name }}</x-slot>
    <livewire:show-author-component :author="$author"/>
</x-layout>
