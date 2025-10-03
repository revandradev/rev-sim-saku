<?php
namespace App\Filament\User\Resources\Histories\Pages;

use App\Filament\User\Resources\Histories\HistoryResource;
use Filament\Resources\Pages\ListRecords;

class ListHistories extends ListRecords
{
    protected static string $resource = HistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
