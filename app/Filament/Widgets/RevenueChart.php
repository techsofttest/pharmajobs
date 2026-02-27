<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Monthly Revenue';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Revenue (₹)',
                    'data' => [25000, 32000, 41000, 38000, 52000, 61000],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}