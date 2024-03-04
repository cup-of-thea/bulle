<?php

namespace App\Domain\ValueObjects;

use Livewire\Wireable;

readonly class Category implements Wireable
{
    private function __construct(
        public CategoryId $categoryId,
        public string $title,
        public string $slug,
    )
    {
    }

    public static function fromLivewire($value): self
    {
        return new self(CategoryId::from($value->categoryId), $value->title, $value->slug);
    }

    public static function from(CategoryId $from, string $title, string $slug): self
    {
        return new self($from, $title, $slug);
    }

    public function toLivewire(): array
    {
        return [
            'categoryId' => $this->categoryId->value(),
            'title' => $this->title,
            'slug' => $this->slug,
        ];
    }
}
