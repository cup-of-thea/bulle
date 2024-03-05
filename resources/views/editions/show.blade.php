<x-layout>
    <x-slot name="metaTitle">{{ $edition->title }}</x-slot>
    <livewire:show-edition-component :edition="$edition"/>
</x-layout>
