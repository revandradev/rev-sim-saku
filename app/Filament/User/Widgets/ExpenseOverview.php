<?php
namespace App\Filament\User\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExpenseOverview extends StatsOverviewWidget
{

    protected function getStats(): array
    {
        $bulanAktif = now()->format('m');
        $tahunAktif = now()->format('Y');

        $summary = \App\Models\Expense::whereMonth('date', $bulanAktif)
            ->whereYear('date', $tahunAktif)
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->pluck('total', 'category_id')
            ->toArray();

        $pemasukan   = $summary[1] ?? 0;
        $pengeluaran = $summary[2] ?? 0;

        // Query pengeluaran terbesar bulan ini (kategori_id = 2)
        $saldo = $pemasukan - $pengeluaran;

        $saldoBulanIni = $saldo ? number_format($saldo, 0, ',', '.') : '0';
        return [
            Stat::make('Pemasukan Bulan Ini', number_format($pemasukan, 0, ',', '.'))
                ->description('Pemasukan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Pengeluaran Bulan Ini', number_format($pengeluaran, 0, ',', '.'))
                ->description('Pengeluaran')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Saldo', $saldoBulanIni)
                ->description('Saldo Bulan Ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger'),
        ];
    }
}
