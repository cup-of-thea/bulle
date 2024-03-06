<?php

namespace App\Domain\ValueObjects;

readonly class PostItemAuthor
{
    private function __construct(
        public string $name,
        public string $slug,
    ) {
    }

    public static function from(
        string $name,
        string $slug,
    ): self {
        return new self($name, $slug);
    }

    public function image(): string
    {
        return config("authors.{$this->slug}.image")
            ?: "https://ui-avatars.com/api/?name={$this->name}&color=7F9CF5&background=EBF4FF&size=256&rounded=true&bold=true&font-size=0.40";
    }

    public function bio(): ?string
    {
        return config("authors.{$this->slug}.bio") ?: null;
    }

    public function twitter(): ?string
    {
        return config("authors.{$this->slug}.twitter") ?: null;
    }

    public function linkedin(): ?string
    {
        return config("authors.{$this->slug}.linkedin") ?: null;
    }

    public function github(): ?string
    {
        return config("authors.{$this->slug}.github") ?: null;
    }

    public function mastodon(): ?string
    {
        return config("authors.{$this->slug}.mastodon") ?: null;
    }

    public function tiktok(): ?string
    {
        return config("authors.{$this->slug}.tiktok") ?: null;
    }

    public function instagram(): ?string
    {
        return config("authors.{$this->slug}.instagram") ?: null;
    }

    public function youtube(): ?string
    {
        return config("authors.{$this->slug}.youtube") ?: null;
    }

    public function threads(): ?string
    {
        return config("authors.{$this->slug}.threads") ?: null;
    }

    public function website(): ?string
    {
        return config("authors.{$this->slug}.website") ?: null;
    }

    public function title(): ?string
    {
        return config("authors.{$this->slug}.title") ?: null;
    }
}
