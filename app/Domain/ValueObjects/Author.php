<?php

namespace App\Domain\ValueObjects;

use Illuminate\Support\Collection;
use Livewire\Wireable;

readonly class Author implements Wireable
{
    private function __construct(
        public AuthorId $authorId,
        public string $name,
        public string $slug,
        public string $title,
        public string $bio,
        public string $image,
        public Collection $links,
    ) {
    }

    public static function from(
        AuthorId $authorId,
        string $name,
        string $slug,
        string $title,
        string $bio,
        string $image,
        Collection $links,
    ): Author {
        return new self(
            authorId: $authorId,
            name: $name,
            slug: $slug,
            title: $title,
            bio: $bio,
            image: $image,
            links: $links,
        );
    }

    public static function fromLivewire($value): self
    {
        return Author::from(
            authorId: $value['authorId'],
            name: $value['name'],
            slug: $value['slug'],
            title: $value['title'],
            bio: $value['bio'],
            image: $value['image'],
            links: $value['links'],
        );
    }

    public function toLivewire(): array
    {
        return [
            'id' => $this->authorId->value(),
            'name' => $this->name,
            'slug' => $this->slug,
            'title' => $this->title,
            'bio' => $this->bio,
            'image' => $this->image,
            'links' => $this->links,
        ];
    }
}