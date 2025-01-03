<?php

namespace App\Models;

use App\Models\Traits\HasLastPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Builder;


/**
 * @property string $title
 * @property string $slug
 */
class Edition extends Model
{
    use HasFactory;
    use HasLastPost;
    use HasSlug;

    protected $withCount = ['posts'];

    protected static function booted(): void
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder
                ->where('status', 'published')
            ;
        });
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_edition');
    }
}
