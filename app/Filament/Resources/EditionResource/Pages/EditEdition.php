<?php

namespace App\Filament\Resources\EditionResource\Pages;

use App\Filament\Resources\EditionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEdition extends EditRecord
{
    protected static string $resource = EditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
