<?php

namespace App\Domain\ValueObjects;

class TagItem
{
    public function __construct(public string $title, public string $slug)
    {
    }

    public static function from(string $title, string $slug): self
    {
        return new self($title, $slug);
    }
}
