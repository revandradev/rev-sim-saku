<?php
namespace App\Filament\User\Resources\Histories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HistoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('date')
                    ->label('Tanggal')
                    ->date(),
                TextEntry::make('category.name')
                    ->label('Kategori')
                    ->formatStateUsing(fn($state) => ucwords($state)),
                TextEntry::make('description')
                    ->label('Deskripsi'),
                TextEntry::make('amount')
                    ->label('Jumlah')
                    ->formatStateUsing(fn($state) => number_format($state, 0, '.', '.')),
                TextEntry::make('created_at')
                    ->label('Input')
                    ->dateTime(),
            ]);
    }
}
