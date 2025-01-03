<?php

namespace App\Filament\Resources;

use App\Filament\Forms\Actions\GenerateSlugAction;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $label = 'Article';

    protected static ?string $navigationIcon = 'iconoir-post';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Contenu')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->maxLength(255)
                            ->hintAction(GenerateSlugAction::make()),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabledOn('edit')
                            ->readOnlyOn('edit'),
                        Forms\Components\Textarea::make('description')
                            ->autosize()
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Brouillon',
                                'published' => 'Publié',
                            ])
                            ->default('draft'),
                        Forms\Components\MarkdownEditor::make('content')
                            ->label('Contenu')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Fieldset::make('Publication')
                    ->schema([
                        Forms\Components\DatePicker::make('date')
                            ->native(false)
                            ->required(),
                        Forms\Components\TextInput::make('canonical')
                            ->label('URL canonique')
                            ->activeUrl()
                            ->maxLength(255),
                    ]),
                Forms\Components\Fieldset::make('Taxonomy')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Catégorie')
                            ->relationship('category', 'title')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->hintAction(GenerateSlugAction::make()),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->required()
                            ->native(false)
                            ->preload(),
                        Forms\Components\Select::make('edition_id')
                            ->label('Édition')
                            ->relationship('edition', 'title')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->hintAction(GenerateSlugAction::make()),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->required()
                            ->native(false)
                            ->preload(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Tables\Grouping\Group::make('category.title')
                    ->label('Catégorie')
                    ->titlePrefixedWithLabel(false)
                    ->getTitleFromRecordUsing(fn (Post $post) => $post->category?->title)
                    ->collapsible(),
                Tables\Grouping\Group::make('edition.title')
                    ->label('Édition')
                    ->titlePrefixedWithLabel(false)
                    ->getTitleFromRecordUsing(fn (Post $post) => $post->edition?->title)
                    ->collapsible(),
            ])
            ->defaultSort('date', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Catégorie')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('edition.title')
                    ->label('Édition')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('authors.name')
                    ->label('Auteur·ices')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'draft' => 'Brouillon',
                        'published' => 'Publié',
                    ]),
                Tables\Columns\TextColumn::make('date')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Création')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Mise à jour')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AuthorsRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
