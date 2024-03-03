<?php

namespace App\Domain\ValueObjects;

readonly class PostItemAuthor
{
    private function __construct(
        public string $name,
        public string $slug,
    )
    {
    }

    public static function from(
        string $name,
        string $slug,
    ): self
    {
        return new self($name, $slug);
    }
}
