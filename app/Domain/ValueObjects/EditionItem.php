<?php

namespace App\Domain\ValueObjects;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class EditionItem
{
    public function __construct(
        public string $title,
        public string $slug,
        public int $postsCount,
        public string $lastPostTitle,
        public string $lastPostSlug,
        public Carbon $lastPostDate,
        public ?Collection $authors,
    ) {
    }

    public static function from(
        string $title,
        string $slug,
        int $postsCount,
        string $lastPostTitle,
        string $lastPostSlug,
        Carbon $lastPostDate,
        ?array $authors,
    ): self {
        return new self(
            $title,
            $slug,
            $postsCount,
            $lastPostTitle,
            $lastPostSlug,
            $lastPostDate,
            collect($authors)->map(fn($author) => PostItemAuthor::from(
                $author->name,
                $author->slug,
                config(
                    "authors.$author->slug.image"
                ) ?? "https://ui-avatars.com/api/?name={$author->name}&color=7F9CF5&background=EBF4FF&size=256&bold=true&font-size=0.40",
            )),
        );
    }
}