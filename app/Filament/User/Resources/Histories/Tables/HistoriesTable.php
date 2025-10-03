<?php
namespace App\Filament\User\Resources\Histories\Tables;

use App\Filament\Exports\HistoryExpensesExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class HistoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->description('Daftar riwayat transaksi')
            ->columns([
                TextColumn::make('id')->label('No.')->rowIndex(),
                TextColumn::make('date')->label('Tanggal')->date()->searchable()->sortable(),
                TextColumn::make('category.name')->label('Kategori')->formatStateUsing(fn($state) => ucwords($state))->searchable()->visibleFrom('md'),
                TextColumn::make('description')->label('Deskripsi')->searchable()->visibleFrom('md'),
                TextColumn::make('amount')->label('Jumlah')->formatStateUsing(fn($state) => number_format($state, 0, '.', '.'))->searchable()->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->relationship('category', 'name'),

            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(HistoryExpensesExporter::class)
                    ->modifyQueryUsing(fn(Builder $query) => $query->with(['category', 'user'])),
            ])
            ->defaultSort('order')
            ->reorderable('order');

    }
}
