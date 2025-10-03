<?php
namespace App\Filament\Exports;

use App\Models\Expense;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ExpenseExporter extends Exporter
{
    protected static ?string $model = Expense::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('user_id')->label('pengguna'),
            ExportColumn::make('category_id')->label('kategori'),
            ExportColumn::make('category.name')->label('nama kategori'),
            ExportColumn::make('description')->label('deskripsi'),
            ExportColumn::make('amount')->label('jumlah'),
            ExportColumn::make('date')->label('tanggal'),
            ExportColumn::make('created_at')->label('dibuat pada'),
            ExportColumn::make('updated_at')->label('diperbarui pada'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your expense export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

}
