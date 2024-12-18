<?php

namespace App\Domain\ValueObjects;

use Carbon\Carbon;
use Illuminate\Support\Collection;

readonly class Post
{
    private function __construct(
        public string $title,
        public string $slug,
        public ?string $description,
        public string $content,
        public Carbon $date,
        public ?Category $category,
        public ?Edition $edition,
        public ?Collection $authors,
        public ?Collection $tags,
        public ?string $canonical,
    ) {
    }

    public static function from(
        string $title,
        string $slug,
        ?string $description,
        string $content,
        Carbon $date,
        ?Category $category,
        ?Edition $edition,
        ?Collection $authors,
        ?array $tags,
        ?string $canonical,
    ): self {
        return new self(
            $title,
            $slug,
            $description,
            $content,
            $date,
            $category,
            $edition,
            $authors,
            collect($tags)->map(fn($tag) => PostItemTag::from($tag->title, $tag->slug)),
            $canonical
        );
    }
}
