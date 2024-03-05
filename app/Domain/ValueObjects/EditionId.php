<?php

namespace App\Domain\ValueObjects;

readonly class EditionId
{
    private function __construct(public int $id)
    {
    }

    public static function from(int $id): self
    {
        return new self($id);
    }

    public function value(): int
    {
        return $this->id;
    }
}