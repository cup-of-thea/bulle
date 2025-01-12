<?php

namespace App\Filament\Pages;

use App\Settings\BannerSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageBanner extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = BannerSettings::class;

    protected static ?string $title = 'Bannière';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Titre')
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label('Description')
                        ->required(),
                    Forms\Components\Checkbox::make('is_active')
                        ->label('Afficher la bannière')
                        ->default(false),
            ]);
    }
}
