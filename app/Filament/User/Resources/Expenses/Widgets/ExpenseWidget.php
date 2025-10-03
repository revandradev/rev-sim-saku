<?php
namespace App\Filament\User\Resources\Expenses\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Illuminate\Support\Facades\Log;

class ExpenseWidget extends ChartWidget
{
    protected ?string $heading    = 'Pemasukan Bulanan';
    protected bool $isCollapsible = true;
    //? protected int|string|array $columnSpan = 'full';
    public ?string $filter = 'year';

    public function getDescription(): ?string
    {
        return 'Jumlah pemasukan bulanan.';
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
        Log::info("Start: $start, End: $end");
        if ($activeFilter == 'today') {
            $trend = Trend::query(Expense::where('category_id', 1))
                ->dateColumn('date')
                ->between(
                    start: $start,
                    end: $end,
                )
                ->perDay()
                ->sum('amount');
            $labels = $trend->map(fn($value) => \Carbon\Carbon::parse($value->date)->format('d M'))->toArray();
        } else {
            $trend = Trend::query(Expense::where('category_id', 1))
                ->dateColumn('date')
                ->between(
                    start: $start,
                    end: $end,
                )
                ->perMonth()
                ->sum('amount');
            $labels = $trend->map(fn($value) => \Carbon\Carbon::parse($value->date)->format('M'))->toArray();
        }

        Log::info('Trend Data: ' . $trend->toJson());
        return [
            'datasets' => [
                [
                    'label'           => 'Pemasukan',
                    'data'            => $trend->map(fn($value) => $value->aggregate)->toArray(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor'     => 'rgba(54, 162, 235, 1)',
                ],
            ],
            'labels'   => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
