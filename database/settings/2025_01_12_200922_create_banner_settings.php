<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('banner.is_active', 'boolean');
        $this->migrator->add('banner.title', 'string');
        $this->migrator->add('banner.description', 'string');
    }
};
