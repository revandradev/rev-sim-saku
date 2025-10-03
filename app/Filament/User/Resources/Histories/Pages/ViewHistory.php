<?php
namespace App\Filament\User\Resources\Histories\Pages;

use App\Filament\User\Resources\Histories\HistoryResource;
use Filament\Resources\Pages\ViewRecord;

class ViewHistory extends ViewRecord
{
    protected static string $resource = HistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
