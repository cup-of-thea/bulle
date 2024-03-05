<x-layout>
    <x-slot name="metaTitle">{{ $category->title }}</x-slot>
    <livewire:show-category-component :category="$category"/>
</x-layout>
