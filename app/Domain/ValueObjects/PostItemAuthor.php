<?php

namespace App\Domain\ValueObjects;

readonly class PostItemAuthor
{
    private function __construct(
        public string $name,
        public string $slug,
        public string $image,
    ) {
    }

    public static function from(
        string $name,
        string $slug,
        string $image,
    ): self {
        return new self($name, $slug, $image);
    }

    public function bio(): ?string
    {
        return config("authors.{$this->slug}.bio") ?: null;
    }

    public function twitter(): ?string
    {
        return config("authors.{$this->slug}.links.twitter") ?: null;
    }

    public function linkedin(): ?string
    {
        return config("authors.{$this->slug}.links.linkedin") ?: null;
    }

    public function github(): ?string
    {
        return config("authors.{$this->slug}.links.github") ?: null;
    }

    public function mastodon(): ?string
    {
        return config("authors.{$this->slug}.links.mastodon") ?: null;
    }

    public function tiktok(): ?string
    {
        return config("authors.{$this->slug}.links.tiktok") ?: null;
    }

    public function instagram(): ?string
    {
        return config("authors.{$this->slug}.links.instagram") ?: null;
    }

    public function youtube(): ?string
    {
        return config("authors.{$this->slug}.links.youtube") ?: null;
    }

    public function threads(): ?string
    {
        return config("authors.{$this->slug}.links.threads") ?: null;
    }

    public function website(): ?string
    {
        return config("authors.{$this->slug}.links.website") ?: null;
    }

    public function title(): ?string
    {
        return config("authors.{$this->slug}.title") ?: null;
    }
}
