<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Author extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function links(): HasMany
    {
        return $this->hasMany(AuthorLink::class);
    }

    public function avatar(): Attribute
    {
        return Attribute::make(
            fn() => $this->image
                ? "/storage/$this->image"
                : "https://ui-avatars.com/api/?name={$this->name}&color=7F9CF5&background=EBF4FF&size=256&bold=true&font-size=0.40"
        );
    }

    public function lastPost(): Attribute
    {
        return Attribute::make(
            fn() => $this->posts->sortByDesc('date')->first()
        );
    }

    public function lastPostDate(): Attribute
    {
        return Attribute::make(
            fn() => $this->posts->sortByDesc('date')->first()?->date ? Carbon::parse(
                $this->posts->sortByDesc('date')->first()->date
            ) : null
        );
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_author');
    }

    public function tags(): HasManyThrough
    {
        return $this->hasManyThrough(Tag::class, Post::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->posts()->with('category')->distinct();
    }
}
