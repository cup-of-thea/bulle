<?php

namespace App\Domain\ValueObjects;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Thea\MarkdownBlog\Domain\ValueObjects\Category;

readonly class PostItem
{
    private function __construct(
        public string      $title,
        public string      $slug,
        public ?string     $description,
        public string      $content,
        public Carbon      $date,
        public ?Category   $category,
        public ?Collection $authors,
        public ?Collection $tags,
    )
    {
    }

    public static function from(
        string    $title,
        string    $slug,
        ?string   $description,
        string    $content,
        Carbon    $date,
        ?Category $category,
        ?array    $authors,
        ?array    $tags,
    ): self
    {
        return new self(
            $title,
            $slug,
            $description,
            $content,
            $date,
            $category,
            collect($authors)->map(fn($author) => PostItemAuthor::from($author->name, $author->slug)),
            collect($tags)->map(fn($tag) => PostItemTag::from($tag->title, $tag->slug)),
        );
    }
}
