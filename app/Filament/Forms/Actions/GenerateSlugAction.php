<?php

namespace App\Filament\Forms\Actions;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Set;

class GenerateSlugAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'Generate slug')
            ->icon('iconoir-link')
            // @phpstan-ignore-next-line
            ->action(fn (Set $set, $state) => $set('slug', str($state)->slug));
    }
}
