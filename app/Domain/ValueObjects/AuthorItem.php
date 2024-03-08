<?php

namespace App\Domain\ValueObjects;

use Carbon\Carbon;

class AuthorItem
{
    public function __construct(
        public string $name,
        public string $slug,
        public string $image,
        public int $postsCount,
        public string $lastPostTitle,
        public string $lastPostSlug,
        public Carbon $lastPostDate
    ) {
    }

    public static function from(
        string $name,
        string $slug,
        string $image,
        int $postsCount,
        string $lastPostTitle,
        string $lastPostSlug,
        Carbon $lastPostDate
    ): self {
        return new self(
            $name,
            $slug,
            $image,
            $postsCount,
            $lastPostTitle,
            $lastPostSlug,
            $lastPostDate
        );
    }
}
