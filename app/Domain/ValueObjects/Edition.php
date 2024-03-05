<?php

namespace App\Domain\ValueObjects;

use Livewire\Wireable;

readonly class Edition implements Wireable
{
    private function __construct(
        public EditionId $editionId,
        public string $title,
        public string $slug
    ) {
    }

    public static function from(EditionId $editionId, string $string, string $string1): self
    {
        return new self($editionId, $string, $string1);
    }

    public static function fromLivewire($value): self
    {
        return new self(EditionId::from($value->editionId), $value->title, $value->slug);
    }

    public function toLivewire(): array
    {
        return [
            'editionId' => $this->editionId->value(),
            'title' => $this->title,
            'slug' => $this->slug,
        ];
    }
}