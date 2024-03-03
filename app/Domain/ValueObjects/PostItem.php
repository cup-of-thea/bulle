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
        public string      $content,
        public Carbon      $date,
        public ?Category   $category,
        public ?Collection $authors,
    )
    {
    }

    public static function from(
        string    $title,
        string    $slug,
        string    $content,
        Carbon    $date,
        ?Category $category,
        ?array    $authors,
    ): self
    {
        return new self(
            $title,
            $slug,
            $content,
            $date,
            $category,
            collect($authors)->map(fn($author) => AuthorItem::from($author->name, $author->slug)),
        );
    }
}
