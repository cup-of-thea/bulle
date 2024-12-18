<?php

namespace App\Filament\Resources\PostResource\RelationManagers;

use App\Filament\Resources\AuthorResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AuthorsRelationManager extends RelationManager
{
    protected static string $relationship = 'authors';

    protected static ?string $label = 'Auteur·ices';

    protected static ?string $title = 'Auteur·ices';

    public function form(Form $form): Form
    {
        return AuthorResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nom'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
