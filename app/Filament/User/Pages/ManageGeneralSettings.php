<?php
namespace App\Filament\User\Pages;

use App\Settings\GeneralSettings;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageGeneralSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static ?string $navigationLabel                   = 'Pegaturan Umum';

    protected static string $settings                          = GeneralSettings::class;
    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort                      = 2;

    protected static ?string $title = 'Pengaturan Umum Aplikasi';
    public function getBreadcrumbs(): array
    {
        return [
            route('filament.user.pages.dashboard')               => 'Dashboard',
            route('filament.user.pages.manage-general-settings') => 'Pengaturan Umum',
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pengaturan Umum Aplikasi')
                    ->description('Atur nama dan slogan aplikasi Anda di sini.')
                    ->columns(12)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Nama Aplikasi')
                            ->required()
                            ->maxLength(255)->columnSpan(6),
                        TextInput::make('site_tagline')
                            ->label('Slogan Aplikasi')
                            ->required()
                            ->maxLength(255)->columnSpan(6),
                    ]),

            ]);
    }
}
