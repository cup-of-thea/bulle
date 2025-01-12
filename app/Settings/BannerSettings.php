<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class BannerSettings extends Settings
{
    public bool $is_active;
    public string $title;
    public string $description;
    public static function group(): string
    {
        return 'banner';
    }
}
