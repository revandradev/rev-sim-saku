<?php
namespace App\Filament\User\Resources\Expenses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->description("Menampilkan daftar pengeluaran per hari ini " . now()->format('d M Y'))
            ->columns([
                TextColumn::make('id')
                    ->label('No.')
                    ->rowIndex(), // Menampilkan nomor urut baris
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->formatStateUsing(fn($state) => ucwords($state))
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Jumlah')
                    ->formatStateUsing(fn($state) => number_format($state, 0, '.', '.'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('date')
                    ->schema([
                        DatePicker::make('date')->label('Date')->default(now()),
                    ])
                    ->query(function ($query, $data) {
                        if ($data['date']) {
                            $query->whereDate('created_at', $data['date']);
                        }
                    }),
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
            ])
            ->recordActions([
                EditAction::make()->badge(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
