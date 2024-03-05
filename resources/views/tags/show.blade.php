<x-layout>
    <x-slot name="metaTitle">#{{ $tag->title }}</x-slot>
    <livewire:show-tag-component :tag="$tag"/>
</x-layout>
