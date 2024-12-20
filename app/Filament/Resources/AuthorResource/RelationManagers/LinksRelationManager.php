<?php

namespace App\Filament\Resources\AuthorResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class LinksRelationManager extends RelationManager
{
    protected static string $relationship = 'links';

    protected static ?string $label = 'Liens';

    protected static ?string $title = 'Liens';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('icon')
                    ->label('Icône')
                    ->options([
                        'iconoir-globe' => 'Site personnel',
                        'iconoir-send-mail' => 'Substack',
                        'ri-bluesky-line' => 'BlueSky',
                        'iconoir-linkedin' => 'Linkedin',
                        'iconoir-puzzle' => 'Compositech',
                        'iconoir-twitter' => 'Twitter',
                        'iconoir-github' => 'GitHub',
                        'iconoir-tiktok' => 'TikTok',
                        'iconoir-threads' => 'Threads',
                        'iconoir-instagram' => 'Instagram',
                        'si-bento' => 'Bento',
                        'iconoir-shop' => 'Boutique',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('url')->activeUrl(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('icon')
            ->columns([
                Tables\Columns\IconColumn::make('icon')
                    ->label('Icône')
                    ->icon(fn ($record) => $record->icon),
                Tables\Columns\TextColumn::make('url')
                    ->url(fn ($record) => $record->url),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
