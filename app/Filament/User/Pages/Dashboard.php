<?php
namespace App\Filament\User\Pages;

use App\Filament\User\Resources\Expenses\Widgets\ExpenseWidget;
use App\Filament\User\Widgets\ExpenseOutChart;
use App\Filament\User\Widgets\ExpenseOverview;
use Filament\Pages\Dashboard as PagesDashboard;

class Dashboard extends PagesDashboard
{
    //? protected string $view = 'filament.user.pages.dashboard';
    public function getWidgets(): array
    {
        return [
            ExpenseOverview::class,
            ExpenseWidget::class,
            ExpenseOutChart::class,
        ];
    }
}
