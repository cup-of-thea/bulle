<?php

namespace App\Domain\ValueObjects\Traits;

trait HasIdBehaviour
{
    private function __construct(public readonly int $id)
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