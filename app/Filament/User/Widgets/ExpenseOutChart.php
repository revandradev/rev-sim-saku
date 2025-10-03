<?php
namespace App\Filament\User\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class ExpenseOutChart extends ChartWidget
{
    protected ?string $heading    = 'Pengeluaran Bulanan';
    protected bool $isCollapsible = true;
    public ?string $filter        = 'year';

    public function getDescription(): ?string
    {
        return 'Jumlah pengeluaran bulanan.';
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week'  => 'Last week',
            'month' => 'Last month',
            'year'  => 'This year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        // Tentukan rentang waktu berdasarkan filter
        switch ($activeFilter) {
            case 'today':
                $start = now()->startOfDay();
                $end   = now()->endOfDay();
                break;
            case 'week':
                $start = now()->subWeek()->startOfDay();
                $end   = now()->endOfDay();
                break;
            case 'month':
                $start = now()->subMonth()->startOfDay();
                $end   = now()->endOfDay();
                break;
            case 'year':
            default:
                $start = now()->startOfYear();
                $end   = now()->endOfYear();
                break;
        }
                                                                // $start = Carbon::create(2025, 1, 1)->startOfDay();
                                                                // $end   = Carbon::create(2025, 12, 31)->endOfDay();
        $trend = Trend::query(Expense::where('category_id', 2)) // filter pengeluaran
            ->dateColumn('date')
            ->between(
                start: $start,
                end: $end,
            )
            ->perMonth()
            ->sum('amount');
        return [
            'datasets' => [
                [
                    'label'           => 'Pengeluaran',
                    'data'            => $trend->map(fn($value) => $value->aggregate)->toArray(),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor'     => 'rgba(255, 99, 132, 1)',
                ],
            ],
            'labels'   => $trend->map(fn($value) => \Carbon\Carbon::parse($value->date)->format('M'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
