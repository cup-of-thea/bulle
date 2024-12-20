<?php

namespace App\Filament\Resources\AuthorResource\RelationManagers;

use App\Filament\Resources\PostResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    protected static ?string $label = 'Articles';

    protected static ?string $title = 'Articles';

    public function form(Form $form): Form
    {
        return PostResource::form($form);
    }

    public function table(Table $table): Table
    {
        return PostResource::table($table)
            ->recordTitleAttribute('title')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->multiple()
                    ->preloadRecordSelect(),
                Tables\Actions\CreateAction::make()
                    ->modalWidth('4xl'),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
