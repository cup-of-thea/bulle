<?php

namespace App\Filament\Resources\AuthorResource\RelationManagers;

use App\Models\AuthorLink;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LinksRelationManager extends RelationManager
{
    protected static string $relationship = 'links';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('icon')
                    ->options([
                        'iconoir-globe' => 'Site personnel',
                        'iconoir-send-mail' => 'Substack',
                        'tabler-brand-bluesky' => 'BlueSky',
                        'iconoir-linkedin' => 'Linkedin',
                        'iconoir-puzzle' => 'Compositech',
                        'iconoir-twitter' => 'Twitter',
                        'iconoir-github' => 'GitHub',
                        'iconoir-tiktok' => 'TikTok',
                        'iconoir-threads' => 'Threads',
                        'iconoir-instagram' => 'Instagram',
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
