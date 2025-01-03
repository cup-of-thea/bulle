<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use function Laravel\Prompts\warning;

class Post extends Model
{
    use HasFactory;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        // scope to only show published posts and from published editions
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('status', 'published');
        });
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'post_author');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function edition(): BelongsTo
    {
        return $this->belongsTo(Edition::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function date(): Attribute
    {
        return Attribute::make(fn (string $date) => Carbon::parse($date));
    }
}
