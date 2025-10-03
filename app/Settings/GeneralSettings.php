<?php
namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $site_name;
    public string $site_tagline;
    public static function group(): string
    {
        return 'general';
    }
}
