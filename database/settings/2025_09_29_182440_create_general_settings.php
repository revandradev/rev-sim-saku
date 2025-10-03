<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Nama Aplikasi Saya');
        $this->migrator->add('general.site_tagline', 'Slogan Keren');

    }
};
