<?php
namespace App\Providers\Filament;

use App\Http\Middleware\EnsureUserRole;
use App\Settings\GeneralSettings;
use Devonab\FilamentEasyFooter\EasyFooterPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
use lockscreen\FilamentLockscreen\Lockscreen;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $settings = app(GeneralSettings::class);
        return $panel
            ->id('user')
            ->path('expenses')
            ->login()
            ->registration()
            ->profile()
            ->brandName($settings->site_name ?? config('app.name', 'Laravel'))
            ->colors([
                'primary' => Color::Sky,
            ])
            // ->topNavigation()
            // ->font('Roboto', provider: SpatieGoogleFontProvider::class)
            ->font('Ubuntu')
            // ->spa(hasPrefetching: true)
            ->spa()
            ->viteTheme('resources/css/filament/user/theme.css')
            ->unsavedChangesAlerts()
            ->databaseNotifications()
            ->pages([Dashboard::class])
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                EnsureUserRole::class,

            ])
            ->authMiddleware([
                Authenticate::class,
                Locker::class,
            ])
            ->plugins([
                EasyFooterPlugin::make()
                    ->withSentence(new HtmlString('Dibuat dengan <span style="color:#e53e3e;">&#10084;&#65039;</span> oleh <strong><a href="#">revandev</a></strong>'
                    ))
                    ->withBorder(true),
                Lockscreen::make()
                    ->enableIdleTimeout()  // Enable auto lock during idle time. Default: Enable, 30 minutes.
                    ->disableDisplayName() // Display the name of the user based on the attribute supplied. Default: name
                    ->enablePlugin(),

            ])
            ->discoverResources(app_path('Filament/User/Resources'), 'App\\Filament\\User\\Resources')
            ->discoverPages(app_path('Filament/User/Pages'), 'App\\Filament\\User\\Pages')
            ->discoverWidgets(app_path('Filament/User/Widgets'), 'App\\Filament\\User\\Widgets');
    }

}
