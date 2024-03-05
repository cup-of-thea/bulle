<?php

namespace App\Domain\ValueObjects;

use Livewire\Wireable;

class Tag implements Wireable
{
    private function __construct(
        public TagId $tagId,
        public string $title,
        public string $slug,
    )
    {
    }

    public static function fromLivewire($value): self
    {
        return new self(TagId::from($value->categoryId), $value->title, $value->slug);
    }

    public static function from(TagId $tagId, string $title, string $slug): self
    {
        return new self($tagId, $title, $slug);
    }

    public function toLivewire(): array
    {
        return [
            'tagId' => $this->tagId->value(),
            'title' => $this->title,
            'slug' => $this->slug,
        ];
    }
}
