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
        ?array $authors,
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
            collect($authors)->map(fn($author) => PostItemAuthor::from(
                $author->name,
                $author->slug,
                config(
                    "authors.$author->slug.image"
                ) ?? "https://ui-avatars.com/api/?name={$author->name}&color=7F9CF5&background=EBF4FF&size=256&bold=true&font-size=0.40",
            )),
            collect($tags)->map(fn($tag) => PostItemTag::from($tag->title, $tag->slug)),
            $canonical
        );
    }
}
