<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function image(): Attribute
    {
        return Attribute::make(
            fn(?string $image) => $image
                ? "/storage/$image"
                : "https://ui-avatars.com/api/?name={$this->name}&color=7F9CF5&background=EBF4FF&size=256&bold=true&font-size=0.40"
        );
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_author');
    }
}
